<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class TransaksiCtrl extends Controller
{
    //
    function form(){   
        // Data Page
        $data = [
            "title" => "Transaksi",
            "page_title" => "Transaksi",
            "menus" => Menu::where("stok","Available")->get()
        ];

        return view("transaksi.frm_transaksi",$data);
    }
}
