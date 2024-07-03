<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriProdukControllerApi extends Controller
{
    public function index()
    {
        $data = Kategori_produk::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function show(string $id)
    {
        $data = Kategori_produk::find($id);
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
        $kategori = Kategori_produk::find($id);
        if ($kategori) {
            $products = Produk::where('id_kategori', $id)->get();
            return response()->json([
                'status' => true,
                'message' => 'Products found',
                'data' => $products
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }
}

