<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        $totalUsers = User::count();
        // $pengguna = Pengguna::paginate(5);
        $produk = Produk::count();
        $pengguna = Pengguna::count();
        $totalTransaksi = Transaksi::count();
        // $posisis = Posisi::count();
        // $evaluasis = Evaluasi::all();
        return view('index',[
            'totalUsers' => $totalUsers,
            'userName' => $userName,
            'pengguna' => $pengguna,
            'produk' => $produk,
            'totalTransaksi' => $totalTransaksi
        ]);

    }
}
