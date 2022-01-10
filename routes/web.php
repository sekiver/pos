<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CtrlMenu;
use App\Http\Controllers\MemberCtrl;

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
Route::get('/menu',[CtrlMenu::class,'index']);
Route::get('/menu/form/{id?}',[CtrlMenu::class,'form']);
Route::post('/menu/save',[CtrlMenu::class,'save']);
Route::get('/menu/delete/{id}',[CtrlMenu::class,'delete']);

// Menu
Route::get('/member',[MemberCtrl::class,'index']);
Route::get('/member/form/{id?}',[MemberCtrl::class,'form']);
Route::post('/member/save',[MemberCtrl::class,'save']);


