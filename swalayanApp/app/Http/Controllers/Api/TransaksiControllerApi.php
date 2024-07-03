<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;

class TransaksiControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_pengguna' => 'required',
            'detail_transaksi' => 'required|array|min:1',
            'detail_transaksi.*.id_produk' => 'required',
            'detail_transaksi.*.jumlah' => 'required',
            //validasi subtotal dihitung di dalam loop
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        // Simpan data transaksi
        $transaksi = new Transaksi();
        $transaksi->id_transaksi = $request->id_transaksi;
        $transaksi->id_pengguna = $request->id_pengguna;
        $transaksi->save();

        // Simpan detail transaksi
        $totalHarga = 0;
        foreach ($request->detail_transaksi as $detail) {
            // Pengecekan ketersediaan produk
            $produk = Produk::find($detail['id_produk']);
            if (!$produk) {
                return response()->json([
                    'status' => false,
                    'message' => 'Produk tidak ditemukan.',
                ], 404);
            }

            // Menghitung subtotal berdasarkan harga produk dan jumlah
            $subtotal = $produk->harga * $detail['jumlah'];

            // Validasi subtotal
            if ($subtotal <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Subtotal tidak valid.',
                ], 400);
            }

            // Simpan detail transaksi
            $detailTransaksi = new Detail_transaksi();
            $detailTransaksi->id_transaksi = $transaksi->id_transaksi;
            $detailTransaksi->id_produk = $detail['id_produk'];
            $detailTransaksi->jumlah = $detail['jumlah'];
            $detailTransaksi->subtotal = $subtotal;
            $detailTransaksi->save();

            // Kurangi stok produk
            $produk->stok -= $detail['jumlah'];
            $produk->save();

            $totalHarga += $subtotal;
        }

        // Update total harga transaksi
        $transaksi->total_harga = $totalHarga;
        $transaksi->save();

        return response()->json([
            'status' => true,
            'message' => 'Transaksi berhasil disimpan.',
            'data' => $transaksi,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Transaksi::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}
