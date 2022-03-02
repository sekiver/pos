<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class ApiCtrl extends Controller
{
    function get_menu(Request $req){
        if($req->kategori){
            $menus = Menu::where("kategori",$req->kategori)->get();
        } else {
            $menus = Menu::All();
        }
        return response()->json($menus);
    }

    function get_menu_favorite(){
        $menus = DB::table("tb_menu")
        ->join("tb_detail_transaksi","tb_detail_transaksi.id_menu","=","tb_menu.id_menu")
        ->selectRaw("tb_menu.*,SUM(tb_detail_transaksi.jumlah) as total")
        ->groupByRaw("tb_menu.id_menu,tb_menu.kd_menu,tb_menu.nm_menu,tb_menu.harga,tb_menu.kategori,tb_menu.satuan,tb_menu.stok,tb_menu.ket,tb_menu.foto,tb_menu.created_at,tb_menu.updated_at")
        ->orderByRaw("SUM(tb_detail_transaksi.jumlah) DESC")
        ->limit(5)
        ->get();

        return response()->json(collect($menus));
    }
}
