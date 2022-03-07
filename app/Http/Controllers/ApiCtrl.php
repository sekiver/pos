<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Menu;
use App\Models\User;

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
        ->groupByRaw("tb_menu.id_menu,tb_menu.kd_menu,tb_menu.nm_menu,tb_menu.harga,tb_menu.kategori,tb_menu.satuan,tb_menu.stok,tb_menu.ket,tb_menu.foto,tb_menu.fav,tb_menu.created_at,tb_menu.updated_at")
        ->orderByRaw("SUM(tb_detail_transaksi.jumlah) DESC")
        ->limit(5)
        ->get();

        return response()->json(collect($menus));
    }

    function update_menu_favorite(Request $req){
        Menu::where("id_menu",$req->id)
        ->update([
            "fav" => $req->fav
        ]);

        return response()->json(["error"=>0]);
    }

    function login(Request $req){
        // Data JSON from IONIC
        $login = $req->json()->all();

        // Untuk cek data user berdasarkan email
        $user = User::where("email",$login["email"])->first();

        if($user){
            // JIka Ada
            if(Hash::check($login["password"],$user->password)){
                // Jika Password benar
                $mess  = ["error"=>0,"mess"=>"Berhasil Login !","data"=>collect($user)];
            } else {
                // Jika Password Salah
                $mess  = ["error"=>1,"mess"=>"Password Not Match !","data"=>null];
            }
        } else {
            // Jika tidak ditemukan
            $mess  = ["error"=>1,"mess"=>"Email Not Found !","data"=>null];
        }
    
        return response()->json($mess);
    }
}
