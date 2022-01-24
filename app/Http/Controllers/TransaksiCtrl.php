<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Member;
use App\Models\Meja;

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
}


