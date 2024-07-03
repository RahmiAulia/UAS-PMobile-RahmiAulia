<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\KategoriPembayaranController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UlasanController;
use App\Http\Middleware\Admin;
use App\Models\Kategori_pembayaran;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth.check')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/logout', [LoginController::class, 'logout']);


    // Rute untuk menampilkan daftar pengguna (GET)
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::middleware('pegawai')->group(function () {
        Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

    Route::get('/detail-transaksi', [DetailTransaksiController::class, 'index'])->name('detail-transaksi.index');
    Route::post('/detail-transaksi', [DetailTransaksiController::class, 'store'])->name('detail-transaksi.store');

    Route::get('/kategori-produk', [KategoriProdukController::class, 'index'])->name('kategori-produk.index');
    Route::middleware('pegawai')->group(function () {
        Route::post('/kategori-produk', [KategoriProdukController::class, 'store'])->name('kategori-produk.store');
        Route::get('/kategori-produk/{id}/edit', [KategoriProdukController::class, 'edit'])->name('kategori-produk.edit');
        Route::put('/kategori-produk/{id}', [KategoriProdukController::class, 'update'])->name('kategori-produk.update');
        Route::get('/kategori-produk/create', [KategoriProdukController::class, 'create'])->name('kategori-produk.create');
        Route::delete('/kategori-produk/{id}', [KategoriProdukController::class, 'destroy'])->name('kategori-produk.destroy');
    });

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::middleware('pegawai')->group(function () {
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    });


    Route::get('/kategori-pembayaran', [KategoriPembayaranController::class, 'index'])->name('kategori-pembayaran.index');
    Route::middleware('pegawai')->group(function () {
        Route::post('/kategori-pembayaran', [KategoriPembayaranController::class, 'store'])->name('kategori-pembayaran.store');
        Route::get('/kategori-pembayaran/{id}/edit', [KategoriPembayaranController::class, 'edit'])->name('kategori-pembayaran.edit');
        Route::put('/kategori-pembayaran/{id}', [KategoriPembayaranController::class, 'update'])->name('kategori-pembayaran.update');
        Route::get('/kategori-pembayaran/create', [KategoriPembayaranController::class, 'create'])->name('kategori-pembayaran.create');
        Route::delete('/kategori-pembayaran/{id}', [KategoriPembayaranController::class, 'destroy'])->name('kategori-pembayaran.destroy');
    });

    Route::get('/pengiriman', [ShippingController::class, 'index'])->name('pengiriman.index');
    Route::post('/pengiriman', [ShippingController::class, 'store'])->name('pengiriman.store');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

    Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::middleware('admin')->group(function () {
        Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
        Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    });
});

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
