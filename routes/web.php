<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\MenuCtrl;
use App\Http\Controllers\MemberCtrl;
use App\Http\Controllers\UserCtrl;
use App\Http\Controllers\TransaksiCtrl;
use App\Http\Controllers\ReportCtrl;

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

Route::get('/',[DashboardCtrl::class,'index']);

Route::group(['middleware' => ['isAdmin']],function(){

    //Menu
    Route::get('/menu/form/{id?}',[MenuCtrl::class,'form']);
    Route::post('/menu/save',[MenuCtrl::class,'save']);
    Route::get('/menu/delete/{id}',[MenuCtrl::class,'delete']);

    // User
    Route::get('/user',[UserCtrl::class,'index']);
    Route::get('/user/form/{id?}',[UserCtrl::class,'form']);
    Route::post('/user/save',[UserCtrl::class,'save']);
    Route::get('/user/delete/{id}',[UserCtrl::class,'delete']);
});

Route::group(['middleware' => ['isOperator']],function(){

    // Member
    Route::get('/member',[MemberCtrl::class,'index']);
    Route::get('/member/form/{id?}',[MemberCtrl::class,'form']);
    Route::post('/member/save',[MemberCtrl::class,'save']);
    Route::get('/member/delete/{id}',[MemberCtrl::class,'delete']);    

    // Menu
    Route::get('/menu',[MenuCtrl::class,'index']);

    // Transaksi
    Route::get('/transaksi',[TransaksiCtrl::class,'index']);
    Route::get('/transaksi/form',[TransaksiCtrl::class,'form']);
    Route::post('/transaksi/save',[TransaksiCtrl::class,'save']);
    Route::get('/transaksi/delete/{id}',[TransaksiCtrl::class,'delete']);
    Route::get('/transaksi/nota/{id}',[TransaksiCtrl::class,'generate_nota']);

    // Laporan
    Route::get('/report/transaksi',[ReportCtrl::class,'index']);
    Route::post('/report/cetak/transaksi',[ReportCtrl::class,'rpt_transaksi']);
    Route::post('/report/cetak/trmember',[ReportCtrl::class,'rpt_transaksi_member']);
    Route::get('/report/cetak/menu',[ReportCtrl::class,'rpt_menu']);
    Route::get('/report/cetak/member',[ReportCtrl::class,'rpt_member']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
