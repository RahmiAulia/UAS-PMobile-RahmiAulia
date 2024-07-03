<?php

namespace App\Http\Controllers;

use App\Models\Kategori_pembayaran;
use Illuminate\Http\Request;

class KategoriPembayaranController extends Controller
{
    public function index (){
        return view('kategoriPembayaran.index', ['kategori_pembayarans' => Kategori_pembayaran::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('kategoriPembayaran.create', ['kategori_pembayarans' => Kategori_pembayaran::all()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_pembayaran' => 'required',
        ]);

        Kategori_pembayaran::create($validatedData);
        return redirect('/kategori-pembayaran')->with('pesan', 'Data Saved');
    }

    public function edit(string $id_kategori_pembayaran)
    {
        return view('kategoriPembayaran.edit', ['kategori_pembayarans' => Kategori_pembayaran::find($id_kategori_pembayaran)]);
    }

    public function update(Request $request, string $id_kategori_pembayaran)
    {

        $validatedData = $request->validate([
            'jenis_pembayaran' => 'required',
            
        ]);
        Kategori_pembayaran::where('id_kategori_pembayaran', $id_kategori_pembayaran)->update($validatedData);
        return redirect('/kategori-pembayaran')->with('pesan', 'Data success updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kategori_pembayaran)
    {
        Kategori_pembayaran::destroy($id_kategori_pembayaran);
        return redirect('/kategori-pembayaran')->with('pesan', 'Data succsess deleted');
    }
}
