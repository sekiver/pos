<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuCtrl extends Controller
{
    //
    function index(){
        // Data Page
        $data = [
            "title" => "Menus",
            "page_title" => "Menus",
            "menus" => Menu::All()
        ];

        return view("menu.data_menu",$data);
    }

    function form(Request $req){
        $mode = $req->id!="" ? "Edit" : "Add New";        
        // Data Page
        $data = [
            "title" => $mode." Menu",
            "page_title" => $mode." Menu",
            "rsMenu" => Menu::where("id_menu",$req->id)->first()
        ];

        return view("menu.frm_menu",$data);
    }

    function save(Request $req){
        // Validation
        $req->validate(
            // Rule
            [
                "kd_menu" => "required|size:6|unique:tb_menu,kd_menu,".$req->input("id_menu").",id_menu",
                "nm_menu" => "required",
                "kategori" => "required",
                "harga" => "required|numeric",
                "satuan" => "required",
                "stok" => "required",
            ],
            // Message Error
            [
                "kd_menu.required" => "Kode Menu Wajib diisi !!",
                "kd_menu.size" => "Kode Menu Harus 6 Karakter !!",
                "kd_menu.unique" => "Kode Menu Sudah digunakan",
                "nm_menu.required" => "Nama Menu Wajib diisi !!",
                "kategori.required" => "Kota Wajib diisi !!",
                "harga.required" => "Harga Wajib diisi !!",
                "harga.numeric" => "Harga Harus diisi dengan angka !!",
                "satuan.required" => "Satuan Wajib diisi !!",
                "stok.required" => "Stok Wajib diisi !!",
            ]
        );

        try {
            // Proses Save
            Menu::UpdateorCreate(
                [
                    "id_menu" => $req->input("id_menu")
                ],
                [
                    "kd_menu"=>$req->input("kd_menu"),
                    "nm_menu"=>$req->input("nm_menu"),
                    "harga"=>$req->input("harga"),
                    "kategori"=>$req->input("kategori"),
                    "satuan"=>$req->input("satuan"),
                    "ket"=>$req->input("ket"),
                    "stok"=>$req->input("stok"),
                    "foto"=>$req->input("foto"),
                ]
            );

            // Data yang dibwa saat berhasil
            $mess = ["type"=>"success","text"=>"Data Berhasil disimpan !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal disimpan !!"];
        }

        // Redirect
        return redirect('menu')->with($mess);
    } 

    function delete(Request $req){
        try {
            Menu::where("id_menu",$req->id)->delete();
            $mess = ["type"=>"success","text"=>"Data Berhasil dihapus !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal dihapus !!"];
        }
        // Redirect
        return redirect('menu')->with($mess);
    }
}
