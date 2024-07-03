<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengguna::all();
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
        $dataPengguna = new Pengguna;

        $rules = [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'no_telepon' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data',
                'data' => $validator->errors()
            ]);
        }

        $dataPengguna->nama = $request->nama;
        $dataPengguna->email = $request->email;
        $dataPengguna->password = $request->password;
        $dataPengguna->alamat = $request->alamat;
        $dataPengguna->no_telepon = $request->no_telepon;

        $dataPengguna->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data',
            'data' => $dataPengguna
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pengguna::find($id);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataPengguna = Pengguna::find($id);
        if (empty($dataPengguna)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $rules = [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'no_telepon' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ]);
        }

        $dataPengguna->nama = $request->nama;
        $dataPengguna->email = $request->email;
        $dataPengguna->password = $request->password;
        $dataPengguna->alamat = $request->alamat;
        $dataPengguna->no_telepon = $request->no_telepon;

        $post = $dataPengguna->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataPengguna = Pengguna::find($id);
        if (empty($dataPengguna)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $post = $dataPengguna->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menghapus data'
        ]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 400);
        }

        $pengguna = Pengguna::where('email', $request->email)->first();

        if ($pengguna && $pengguna->password == $request->password) {
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data' => $pengguna
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }
    }
}
