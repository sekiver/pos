<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CtrlMenu extends Controller
{
    // Data Menu
    function index(){

        // Data Page
        $data = [
            "title" => "Menus",
            "page_title" => "Menus",
            "menus" => [
                [
                    "id_menu" => 1,
                    "nm_menu" => "Soto Ayam",
                    "harga" => 5000,
                    "cat" => "Makanan",
                    "desc" => "Soto dengan cita rasa Soto Lamongan",
                    "status" => 1,
                ],
                [
                    "id_menu" => 2,
                    "nm_menu" => "Nasi Goreng",
                    "harga" => 10000,
                    "cat" => "Makanan",
                    "desc" => "Nasi Goreng dengan irisan bawang",
                    "status" => 1,
                ],
                [
                    "id_menu" => 3,
                    "nm_menu" => "Es Degan",
                    "harga" => 7500,
                    "cat" => "Minuman",
                    "desc" => "Es Degan asli dengan madu",
                    "status" => 1,
                ],                
            ]
        ];

        return view('data_menu',$data);
    }

    // Form Menu
    function form(){
        $data = [
            "title" => "Form Menu",
            "page_title" => "Add Menu",
        ];

        return view('frm_menu',$data);
    }

    function save(){

    }

    function delete(){
        
    }
}
