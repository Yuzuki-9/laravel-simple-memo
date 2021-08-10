<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Auth::routes();

// URLに名前をつけておくと、formのaction属性にroute関数でURLを定義できる
Route::get('/home', [HomeController::class, 'index'])->name('home');  // getはURLにアクセスしてページを見に行く（データを取りに行く）
Route::post('/store', [HomeController::class, 'store'])->name('store');  // なにか保存したいとき（データを投げる）
