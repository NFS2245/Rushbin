<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    return view('landingpage');
});

Route::get('/login', [AuthController::class, 'LoginPage'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {

    //dashboard
    Route::get('/dashboard',[App\Http\Controllers\DaftarSampahController::class,'daftarsampah'])
    ->name('dashboard');
    Route::post('/dashboard',[App\Http\Controllers\DaftarSampahController::class,'store'])
    ->name('daftarsampah.tambah');
    Route::delete('/dashboard/{id_sampah}', [App\Http\Controllers\DaftarSampahController::class, 'destroy'])
    ->name('daftarsampah.destroy');
    Route::put('/dashboard/{id_sampah}', [App\Http\Controllers\DaftarSampahController::class, 'update'])
    ->name('daftarsampah.update');

    //transaksi jual
    Route::get('/transaksi_jual',[App\Http\Controllers\TransaksiController::class,'transaksijual'])
    ->name('transaksi.jual');
    Route::post('/transaksi_jual',[App\Http\Controllers\TransaksiController::class,'store'])
    ->name('transaksijual.tambah');
    Route::post('/transaksi_jual_bayar',[App\Http\Controllers\TransaksiController::class,'store2'])
    ->name('transaksijual.bayar');
    Route::delete('/transaksi_jual_bayar/{kode_transaksi}',[App\Http\Controllers\TransaksiController::class,'destroyjual'])
    ->name('transaksijual.destroy');

    //transaksi beli
    Route::get('/transaksi_beli',[App\Http\Controllers\TransaksiController::class,'transaksibeli'])
    ->name('transaksi.beli');
    Route::post('/transaksi_beli',[App\Http\Controllers\TransaksiController::class,'storebeli'])
    ->name('transaksibeli.tambah');
    Route::post('/transaksi_jual_beli/{kode_transaksi}',[App\Http\Controllers\TransaksiController::class,'store3'])
    ->name('transaksibeli.bayar');
    Route::delete('/transaksi_jual_beli/{kode_transaksi}',[App\Http\Controllers\TransaksiController::class,'destroybeli'])
    ->name('transaksibeli.destroy');

    //laporan beli
    Route::get('/laporan_beli',[App\Http\Controllers\LaporanController::class,'laporanbeli'])
    ->name('laporan.beli');
    Route::get('/laporan_beli/{kode_transaksi}',[App\Http\Controllers\LaporanController::class,'laporanorder'])
    ->name('laporan.order');

    //laporan jual
    Route::get('/laporan_jual',[App\Http\Controllers\LaporanController::class,'laporanjual'])
    ->name('laporan.jual');
    Route::get('/laporan_jual/{kode_transaksi}',[App\Http\Controllers\LaporanController::class,'laporanorderjual'])
    ->name('laporan.orderjual');

    Route::get('/laporan_penukaran',[App\Http\Controllers\LaporanController::class,'laporanpenukaran'])
    ->name('laporan.laporanpenukaran');
    Route::put('/laporan_penukaran_Konfirmasi/{id_penukaran}', [App\Http\Controllers\LaporanController::class, 'update'])
    ->name('laporan.penukaran.update');
    Route::put('/laporan_penukaran_Batal/{id_penukaran}', [App\Http\Controllers\LaporanController::class, 'update2'])
    ->name('laporan.penukaran.updategagal');

    Route::get('/pickup',[App\Http\Controllers\PickupController::class,'pickup'])
    ->name('pickup');
    Route::put('/pickup_selesai/{id_pengantaran}',[App\Http\Controllers\PickupController::class,'update'])
    ->name('pickup.pengantaran.selesai');
    Route::put('/pickup_batal/{id_pengantaran}',[App\Http\Controllers\PickupController::class,'update2'])
    ->name('pickup.pengantaran.batal');

    Route::get('/customer',[App\Http\Controllers\CustomerController::class,'customer'])
    ->name('customer');
    Route::put('/customer/{id_pengguna}',[App\Http\Controllers\CustomerController::class,'update'])
    ->name('customer.update');
    Route::delete('/customer/{id_pengguna}',[App\Http\Controllers\CustomerController::class,'destroy'])
    ->name('customer.destroy');

    

    Route::get('/logout',[App\Http\Controllers\AuthController::class,'logout']);
});