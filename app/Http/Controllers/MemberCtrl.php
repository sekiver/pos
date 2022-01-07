<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberCtrl extends Controller
{
    //
    function index(){
         // Data Page
         $data = [
            "title" => "Members",
            "page_title" => "Members",
            "members" => Member::All()
         ];

         return view("member.data_member",$data);
    }
}


