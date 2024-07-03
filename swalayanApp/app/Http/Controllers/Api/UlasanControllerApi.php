<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UlasanControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ulasan::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required',
            'id_pengguna' => 'required',
            'ulasan' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Simpan ulasan
        $ulasan = new Ulasan();
        $ulasan->id_produk = $request->id_produk;
        $ulasan->id_pengguna = $request->id_pengguna;
        $ulasan->ulasan = $request->ulasan;
        $ulasan->rating = $request->rating;
        $ulasan->save();

        // Kembalikan respons berhasil
        return response()->json([
            'status' => true,
            'message' => 'Ulasan berhasil disimpan.',
            'data' => $ulasan,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ulasan = Ulasan::find($id);
        if ($ulasan) {
            return response()->json([
                'status' => true,
                'message' => 'Ulasan ditemukan',
                'data' => $ulasan
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Ulasan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required',
            'id_pengguna' => 'required',
            'ulasan' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Temukan dan perbarui ulasan
        $ulasan = Ulasan::find($id);
        if ($ulasan) {
            $ulasan->id_produk = $request->id_produk;
            $ulasan->id_pengguna = $request->id_pengguna;
            $ulasan->ulasan = $request->ulasan;
            $ulasan->rating = $request->rating;
            $ulasan->save();

            return response()->json([
                'status' => true,
                'message' => 'Ulasan berhasil diperbarui.',
                'data' => $ulasan,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Ulasan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan dan hapus ulasan
        $ulasan = Ulasan::find($id);
        if ($ulasan) {
            $ulasan->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ulasan berhasil dihapus.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Ulasan tidak ditemukan'
            ], 404);
        }
    }
}
