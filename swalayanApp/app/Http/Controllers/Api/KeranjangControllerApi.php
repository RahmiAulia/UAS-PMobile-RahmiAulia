<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail_keranjang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangControllerApi extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::with('pengguna', 'detailKeranjang')->get();
        return response()->json($keranjangs);
    }

    // Get specific keranjang by id
    public function show($id)
    {
        $keranjang = Keranjang::with('pengguna', 'detailKeranjang')->find($id);
        if (is_null($keranjang)) {
            return response()->json(['message' => 'Keranjang not found'], 404);
        }
        return response()->json($keranjang);
    }

    // Create a new keranjang
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_pengguna' => 'required|exists:penggunas,id_pengguna', // assuming Pengguna model uses 'id' as primary key
        ]);

        $keranjang = Keranjang::create([
            'id_pengguna' => $request->input('id_pengguna'),
        ]);

        return response()->json($keranjang, 201);
    }

    public function addItem(Request $request, $id)
{
    try {
        $this->validate($request, [
            'id_produk' => 'required|exists:produks,id_produk',
            'jumlah' => 'required|integer|min:1', // Perbaiki aturan validasi di sini
        ]);

        $keranjang = Keranjang::find($id);
        if (is_null($keranjang)) {
            return response()->json(['message' => 'Keranjang not found'], 404);
        }

        $detailKeranjang = Detail_keranjang::create([
            'id_keranjang' => $keranjang->id_keranjang,
            'id_produk' => $request->input('id_produk'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return response()->json($detailKeranjang, 201);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan saat menambahkan keranjang: ' . $e->getMessage(),
        ], 500);
    }
}

    // Update an existing keranjang
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_pengguna' => 'required|exists:penggunas,id',
        ]);

        $keranjang = Keranjang::find($id);
        if (is_null($keranjang)) {
            return response()->json(['message' => 'Keranjang not found'], 404);
        }

        $keranjang->update([
            'id_pengguna' => $request->input('id_pengguna'),
        ]);

        return response()->json($keranjang);
    }

    // Delete a keranjang
    public function destroy($id)
    {
        $keranjang = Keranjang::find($id);
        if (is_null($keranjang)) {
            return response()->json(['message' => 'Keranjang not found'], 404);
        }

        $keranjang->delete();
        return response()->json(['message' => 'Keranjang deleted successfully']);
    }
}
