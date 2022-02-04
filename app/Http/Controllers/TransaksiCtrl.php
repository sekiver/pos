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
    function index(){

        // Query Data Transaksi SQL di Grantotal
        /* $transaksi = DB::select("SELECT t.*,u.name,mb.nm_member,mj.no_meja,
        (SELECT SUM(dt.harga*dt.jumlah) AS subtotal FROM tb_detail_transaksi AS dt 
        WHERE dt.id_transaksi = t.id_transaksi) AS gtotal
        FROM tb_transaksi AS t
        INNER JOIN users AS u ON t.id_kasir = u.id
        INNER JOIN tb_member AS mb ON t.id_member = mb.id_member
        INNER JOIN tb_meja AS mj ON t.id_meja = mj.id_meja"); */

        // Tanpa SQL Grantotal
        $transaksi = DB::select("SELECT t.*,u.name,mb.nm_member,mj.no_meja 
        FROM tb_transaksi AS t
        INNER JOIN users AS u ON t.id_kasir = u.id
        INNER JOIN tb_member AS mb ON t.id_member = mb.id_member
        INNER JOIN tb_meja AS mj ON t.id_meja = mj.id_meja");
        
        // Data Page
        $data = [
            "title" => "Transaksi",
            "page_title" => "Transaksi",
            "transaksi" => $transaksi
        ];

        return view("transaksi.data_transaksi",$data);
    }

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
            "gtotal"    => $req->input("gtotal"),
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

        return json_encode(["error"=>0,"type"=>"success","message"=>"Data Berhasil disimpan !!","id_transaksi"=>$id_transaksi]);
    }

    function generate_nota(Request $req){

        // Generate Data using Query Builder
        $transaksi = DB::table("tb_transaksi")
        ->join("users","tb_transaksi.id_kasir","=","users.id")
        ->join("tb_member","tb_transaksi.id_member","=","tb_member.id_member")
        ->join("tb_meja","tb_transaksi.id_meja","=","tb_meja.id_meja")
        ->select("tb_transaksi.*","users.name","tb_member.nm_member","tb_meja.no_meja")
        ->where("tb_transaksi.id_transaksi",$req->id)
        ->first();

        $detail = DB::table("tb_detail_transaksi")
        ->join("tb_menu","tb_detail_transaksi.id_menu","=","tb_menu.id_menu")
        ->select("tb_detail_transaksi.*","tb_menu.nm_menu",DB::raw("(tb_detail_transaksi.harga * tb_detail_transaksi.jumlah) as subtotal"))
        ->where("tb_detail_transaksi.id_transaksi",$req->id)
        ->get();

        // Data Store to View
        $data = [
            "rsTransaksi" => $transaksi,
            "rsDetail" => $detail,
            "total" => 0
        ];

        return view("transaksi.nota",$data);
    }

    // Hapus
    function delete(Request $req){
        try {
            Transaksi::where("id_transaksi",$req->id)->delete();
            DetailTransaksi::where("id_transaksi",$req->id)->delete();
            $mess = ["type"=>"success","text"=>"Data Berhasil dihapus !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal dihapus !!"];
        }
        // Redirect
        return redirect('member')->with($mess);
    }
}


