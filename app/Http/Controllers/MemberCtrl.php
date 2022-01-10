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

    function form(Request $req){
        $mode = $req->id!="" ? "Edit" : "Add New";
        // Data Page
        $data = [
            "title" => $mode." Member",
            "page_title" => $mode." Member",
        // "members" => Member::All()
        ];

        return view("member.frm_member",$data);
    }

    function save(Request $req){

        // Proses Save
        Member::Create([
            "kd_member"=>$req->input("kd_member"),
            "nm_member"=>$req->input("nm_member"),
            "alamat"=>$req->input("alamat"),
            "kota"=>$req->input("kota"),
            "telp"=>$req->input("telp"),
            "jk"=>$req->input("jk"),
            "status"=>$req->input("status"),
            "foto"=>"",
        ]);

        // Redirect
        return redirect('member');
    } 
}


