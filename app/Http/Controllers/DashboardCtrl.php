<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Transaksi;

class DashboardCtrl extends Controller
{
    //
    function index(){

        $data = [
            "total_member" => Member::count(),
            "total_transaksi" => Transaksi::count()
        ];

        return view("dashboard",$data);
    }
}
