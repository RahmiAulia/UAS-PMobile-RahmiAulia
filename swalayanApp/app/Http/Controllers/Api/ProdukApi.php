<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukApi extends Controller
{
    public function index()
    {
        $data = Produk::select('nama_produk', 'harga', 'deskripsi', 'gambar_produk')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $produk = new Produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->gambar_produk = $request->gambar_produk;
        $produk->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data produk',
            'data' => $produk
        ], 201);
    }

    public function show(string $id)
    {
        $data = Produk::find($id);
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
            ], 404);
        }
    }

    public function productsByCategory(string $id)
    {
        $products = Produk::where('id_kategori', $id)->get();
        if ($products->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Products found',
                'data' => $products
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No products found for this category'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->gambar_produk = $request->gambar_produk;
        $produk->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update produk',
            'data' => $produk
        ], 200);
    }

    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $produk->delete();
        return response()->json([
            'status' => true,
            'message' => 'Sukses menghapus data produk'
        ], 200);
    }
}
