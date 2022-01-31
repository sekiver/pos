<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Menu;
use App\Models\Member;
use App\Models\Meja;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiCtrl extends Controller
{
    //
    function form(){   
        // Data Page
        $data = [
            "title" => "Transaksi",
            "page_title" => "Transaksi",
            "menus" => Menu::where("stok","Available")->get(),
            "members" => Member::All(),
            "meja" => Meja::All()
        ];

        return view("transaksi.frm_transaksi",$data);
    }

    function save(Request $req){
        //dd($req->all());
        // Generate Nota
        // Contoh : N20220130083956JU89
        $nota = "N".date("Ymdhis").Str::upper(Str::random(4));

        // Get Next Id Transaksi
        $transaksi=DB::select("SHOW TABLE STATUS LIKE 'tb_transaksi'");
        $id_transaksi=$transaksi[0]->Auto_increment; 

        // Save Transaksi
        Transaksi::create([
            "nota"      => $nota,
            "tanggal"   => date("Y-m-d h:i:s"),
            "id_kasir"  => 1,
            "id_member" => $req->input("id_member"),
            "id_meja"   => $req->input("id_meja"),
            "ppn"       => $req->input("ppn"),
            "diskon"    => $req->input("diskon"),
            "status"    => 1,
        ]);

        // Save Detail
        $id_menu = $req->input("id_menu");
        $harga = $req->input("harga");
        $jumlah = $req->input("jumlah");

        for($i=0;$i<count($id_menu);$i++){
            DetailTransaksi::create([
                "id_transaksi"  => $id_transaksi,
                "id_menu"       => $id_menu[$i],
                "harga"         => $harga[$i],
                "jumlah"        => $jumlah[$i]
            ]);
        }

        
    }
}


