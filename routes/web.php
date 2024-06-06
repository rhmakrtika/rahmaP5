<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//tanbahan dibawah
Route::resource('destinasi', App\Http\Controllers\DestinasiController::class)->middleware('auth');
Route::post('destinasi/export-destinasi', [App\Http\Controllers\DestinasiController::class, 'viewPDF'])->name('destinasi.view-pdf');
Route::resource('pengunjung', App\Http\Controllers\PengunjungController::class)->middleware('auth');
Route::resource('reservasi', App\Http\Controllers\ReservasiController::class)->middleware('auth');
Route::resource('transaksi', App\Http\Controllers\TransaksiController::class)->middleware('auth');
