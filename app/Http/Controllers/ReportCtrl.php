<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportCtrl extends Controller
{
    function rpt_transaksi(){
        $transaksi = DB::table("tb_transaksi")
        ->join("users","tb_transaksi.id_kasir","=","users.id")
        ->join("tb_member","tb_transaksi.id_member","=","tb_member.id_member")
        ->join("tb_meja","tb_transaksi.id_meja","=","tb_meja.id_meja")
        ->select("tb_transaksi.*","users.name","tb_member.nm_member","tb_meja.no_meja")
        ->get();

        $data = [
            "rsTransaksi" => $transaksi,
            "pajak" => 0,
            "total" => 0
        ];

        return view("reports.rpt_transaksi",$data);
    }
}
