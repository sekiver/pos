<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuCtrl;
use App\Http\Controllers\MemberCtrl;
use App\Http\Controllers\UserCtrl;
use App\Http\Controllers\TransaksiCtrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

// Menu
Route::get('/menu',[MenuCtrl::class,'index']);
Route::get('/menu/form/{id?}',[MenuCtrl::class,'form']);
Route::post('/menu/save',[MenuCtrl::class,'save']);
Route::get('/menu/delete/{id}',[MenuCtrl::class,'delete']);

// Member
Route::get('/member',[MemberCtrl::class,'index']);
Route::get('/member/form/{id?}',[MemberCtrl::class,'form']);
Route::post('/member/save',[MemberCtrl::class,'save']);
Route::get('/member/delete/{id}',[MemberCtrl::class,'delete']);

// User
Route::get('/user',[UserCtrl::class,'index']);
Route::get('/user/form/{id?}',[UserCtrl::class,'form']);
Route::post('/user/save',[UserCtrl::class,'save']);
Route::get('/user/delete/{id}',[UserCtrl::class,'delete']);

// Transaksi
Route::get('/transaksi',[TransaksiCtrl::class,'index']);
Route::get('/transaksi/form',[TransaksiCtrl::class,'form']);
Route::post('/transaksi/save',[TransaksiCtrl::class,'save']);
Route::get('/transaksi/delete/{id}',[TransaksiCtrl::class,'delete']);


