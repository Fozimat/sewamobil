<?php

use App\Http\Controllers\KembaliController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PinjamController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {
    Route::resource('mobil', MobilController::class);
    Route::resource('pinjam', PinjamController::class);
    Route::resource('kembali', KembaliController::class);
    Route::get('/getPinjamanInfo/{mobil_id}', [KembaliController::class, 'getPinjamanInfo']);
    Route::get('pinjam/cancel/{pinjam}', [PinjamController::class, 'cancel'])->name('pinjam.cancel');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
