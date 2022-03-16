<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\User;
use App\Models\Member;

class ApiCtrl extends Controller
{
    function get_menu(Request $req){
        if($req->kategori){
            $menus = Menu::where("kategori",$req->kategori)->get();
        } else {
            $menus = Menu::All();
        }
        return response()->json($menus);
    }

    function get_menu_favorite(){
        $menus = DB::table("tb_menu")
        ->join("tb_detail_transaksi","tb_detail_transaksi.id_menu","=","tb_menu.id_menu")
        ->selectRaw("tb_menu.*,SUM(tb_detail_transaksi.jumlah) as total")
        ->groupByRaw("tb_menu.id_menu,tb_menu.kd_menu,tb_menu.nm_menu,tb_menu.harga,tb_menu.kategori,tb_menu.satuan,tb_menu.stok,tb_menu.ket,tb_menu.foto,tb_menu.fav,tb_menu.created_at,tb_menu.updated_at")
        ->orderByRaw("SUM(tb_detail_transaksi.jumlah) DESC")
        ->limit(5)
        ->get();

        return response()->json(collect($menus));
    }

    function update_menu_favorite(Request $req){
        Menu::where("id_menu",$req->id)
        ->update([
            "fav" => $req->fav
        ]);

        return response()->json(["error"=>0]);
    }

    function login(Request $req){
        // Data JSON from IONIC
        $login = $req->json()->all();

        // Untuk cek data user berdasarkan email
        $user = User::where("email",$login["email"])->first();

        if($user){
            //if($user->status==1){
                // JIka Ada
                if(Hash::check($login["password"],$user->password)){
                    // Get Member
                    $member = Member::where("id_member",$user->id_member)->first();
                    // Jika Password benar
                    $mess  = ["error"=>0,"mess"=>"Berhasil Login !","data"=>["user"=>collect($user),"member"=>collect($member)]];
                } else {
                    // Jika Password Salah
                    $mess  = ["error"=>1,"mess"=>"Password Not Match !","data"=>null];
                }
           // } else {
                 // Jika statusnya 0 / belum verification
          //       $mess  = ["error"=>1,"mess"=>"User Not Found !","data"=>null];
           // }
        } else {
            // Jika tidak ditemukan
            $mess  = ["error"=>1,"mess"=>"Email Not Found !","data"=>null];
        }
    
        return response()->json($mess);
    }

    function registrasi(Request $req){
        // Data JSON from IONIC
        $reg = $req->json()->all();        

        // Validation
        $valid = Validator::make(
            $reg,
            // Rule
            [
                "email" =>"email|unique:users,email",
            ],
            // Message Error
            [
                "email.unique" => "Email Sudah Terdaftar !!",
            ]
        );

        if($valid->fails()){
            $mess  = ["error"=>1,"mess"=>"Email Already Exist !","data"=>null];
        } else {
            // Proses Simpan
            $save = User::create([
                "name"=>$reg["name"],
                "email"=>$reg["email"],
                "password"=>Hash::make($reg["password"]),
                "role"=>"Member",
                "status"=>1
            ]);

            if($save){
                $user = User::where("email",$reg["email"])->first();
                //$user->notify(new WelcomeMail());
                $mess  = ["error"=>0,"mess"=>"Registration Success !","data"=>collect($user)];
            } else {
                // Jika Gagal Menyimpan
                $mess  = ["error"=>1,"mess"=>"Oops ! Any something wrong !","data"=>null];
            }
        }

        return response()->json($mess);        
    }

    function member(Request $req){
        $dtMember = $req->json()->all();   
        $kode = Str::upper(Str::random(6));

        //  Update Data Member
        $save = Member::UpdateorCreate(
            [
                "id_member" => $dtMember["id_member"]
            ],
            [
                "kd_member"=>$kode,
                "nm_member"=>$dtMember["nm_member"],
                "alamat"=>$dtMember["alamat"],
                "kota"=>$dtMember["kota"],
                "telp"=>$dtMember["telp"],
                "jk"=>$dtMember["jk"],  
                "foto"=>$dtMember["foto"]
            ]
        );

        if($save){            
            // Get Data User and Member
            $user = User::where("id",$dtMember["user_id"])->first();
            $member = Member::where("kd_member",$kode)->first();

             // Update id_member ke tabel Users jika member berhasil disimpan !
            if($dtMember["id_member"]==""){
                User::where("id",$dtMember["user_id"])->update([
                    "id_member"=>$member->id_member
                ]);

            }

            if($dtMember["id_member"]==""){
                $mess  = ["error"=>0,"mess"=>"Selamat Anda Menjadi Member !","data"=>["user"=>collect($user),"member"=>collect($member)]];
            } else {
                $mess  = ["error"=>0,"mess"=>"Data Updated !","data"=>["user"=>collect($user),"member"=>collect($member)]];
            }
        } else {
            $mess  = ["error"=>1,"mess"=>"Oops ! Any something wrong !","data"=>null];
        }

        return response()->json($mess);
    }
}
