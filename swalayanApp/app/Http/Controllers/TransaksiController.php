<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.index', ['transaksis' => Transaksi::paginate(10)]);
    }

    // Metode untuk menangani penyimpanan transaksi baru
    public function store(Request $request)
    {
        // Validasi request jika diperlukan

        // Mendapatkan id pengguna dari request atau dari pengguna yang sedang login
        $id_pengguna = $request->input('id_pengguna'); // Atau menggunakan informasi pengguna yang sedang login

        // Membuat transaksi baru dengan total harga awal 0
        $transaksi = Transaksi::create([
            'id_pengguna' => $id_pengguna,
            // 'id_transaksi' => $id_transaksi,
            'tanggal_transaksi' => now(),
            'total_harga' => 0,
        ]);

        // Iterasi untuk setiap produk dalam transaksi
        foreach ($request->input('produk') as $item) {
            $produk = Produk::find($item['id_produk']);
            // Hitung subtotal untuk setiap produk
            $subtotal = $produk->harga * $item['jumlah'];

            // Tambahkan detail transaksi
            $transaksi->detailTransaksis()->create([
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $subtotal,
            ]);

            // Tambahkan subtotal ke total harga transaksi
            $transaksi->total_harga += $subtotal;
        }

        // Simpan total harga setelah semua subtotal ditambahkan
        $transaksi->save();

        // Response atau redirect sesuai kebutuhan
        // return redirect('/kategori-pembayaran')->with('pesan', 'Data Saved');
    }
}
