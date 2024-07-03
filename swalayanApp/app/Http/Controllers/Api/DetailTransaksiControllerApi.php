<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail_transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailTransaksiControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Detail_transaksi::all();
        return response()->json([
            'status'=>true,
            'message'=>'Data ditemukan',
            'data'=>$data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required',
            'id_produk' => 'required',
            'jumlah' => 'required',
        ]);


        // Mendapatkan harga produk dari tabel produk berdasarkan id_produk
        $produk = Produk::find($request->id_produk);
        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        $hargaProduk = $produk->harga;

        $detail = new Detail_transaksi();
        $detail->id_transaksi = $request->id_transaksi;
        $detail->id_produk = $request->id_produk;
        $detail->jumlah = $request->jumlah;

        // Menghitung subtotal berdasarkan harga produk dan jumlah
        $subtotal = $hargaProduk * $request->jumlah;

        $detail->subtotal = $subtotal;
        $detail->save();

        return response()->json([
            'status' => true,
            'message' => 'Detail transaksi berhasil disimpan.',
            'data' => $detail,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
