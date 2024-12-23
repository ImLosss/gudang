<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\Admin\MerekController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Karyawan\BarangKeluarController;
use App\Http\Controllers\Karyawan\BarangMasukController;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'auth'])->name('auth');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');



Route::group(
    [
        'middleware' => ['auth'],
        'namespace' => 'App\Http\Controllers',
        'prefix' => '/',
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('merek', MerekController::class);
        Route::resource('type', TypeController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('distributor', DistributorController::class);
        Route::resource('user', UserController::class);

        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangKeluarController::class);




        Route::get('/get-type/{id}', [BarangController::class, 'getType']);
        Route::get('/get-barang/{id}', [BarangMasukController::class, 'getBarang']);
    }


);
