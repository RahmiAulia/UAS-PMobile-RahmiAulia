<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Shipping;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pembayaran::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_kategori_pembayaran' => 'required',
                'tanggal_pembayaran' => 'required',
                'shipping' => 'required|array|min:1',
                'shipping.*.id_transaksi' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            // Simpan pembayaran
            $pembayaran = new Pembayaran();
            $pembayaran->id_kategori_pembayaran = $request->id_kategori_pembayaran;
            $pembayaran->save();

            $totalPembayaran = 0;
            foreach ($request->shipping as $shippingData) {
                $transaksi = Transaksi::find($shippingData['id_transaksi']);

                if (!$transaksi) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Transaksi tidak ditemukan.',
                    ], 404);
                }

                $biaya = ($transaksi->total_harga < 100000) ? 10000 : 6000;

                // Simpan shipping
                $pengiriman = new Shipping();
                $pengiriman->biaya = $biaya;
                $pengiriman->id_transaksi = $transaksi->id_transaksi;
                $pengiriman->id_pembayaran = $pembayaran->id_pembayaran;
                $pengiriman->status = 'dikirim';
                $pengiriman->save();

                // Hitung total pembayaran
                $totalPembayaran += $biaya + $transaksi->total_harga;
            }

            $pembayaran->total_pembayaran = $totalPembayaran;
            $pembayaran->save();



            return response()->json([
                'status' => true,
                'message' => 'Pembayaran berhasil disimpan.',
                'data' => $pembayaran,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan pembayaran: ' . $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementasi metode show
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implementasi metode update
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implementasi metode destroy
    }
}
