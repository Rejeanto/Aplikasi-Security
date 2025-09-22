<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiKerjaController;
use App\Http\Controllers\SoalController;
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

Route::group(['prefix' => 'login'], function () {
  Route::get('/', [LoginController::class, 'index'])->name('login');
  Route::post('/', [LoginController::class, 'login']);
});

Route::get('/', [HomeController::class, 'index']);
Route::post('daftar', [HomeController::class, 'daftar']);
Route::put('start_test/{id}', [HomeController::class, 'start_test']);
Route::put('submit_test/{id}', [HomeController::class, 'submit_test']);

Route::group(['middleware' => 'auth'], function () {
  Route::get('logout', [LoginController::class, 'logout']);
  Route::get('dashboard', [DashboardController::class, 'index']);

  Route::get('soal/data', [SoalController::class, 'getData']);
  Route::resource('soal', SoalController::class);

  Route::get('hasil/data', [HasilController::class, 'getData']);
  Route::resource('hasil', HasilController::class);

  Route::get('lokasi_kerja/data', [LokasiKerjaController::class, 'getData']);
  Route::resource('lokasi_kerja', LokasiKerjaController::class);
});
