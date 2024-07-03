<?php

namespace App\Http\Controllers;

use App\Models\Kategori_produk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index (){
        return view('kategoriProduk.index', ['kategori_produks' => Kategori_produk::paginate(10)]);
    }

    public function create()
    {
        return view('kategoriProduk.create', ['kategori_produks' => Kategori_produk::all()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);

        Kategori_produk::create($validatedData);
        return redirect('/kategori-produk')->with('pesan', 'Data Saved');
    }

    public function edit(string $id_kategori)
    {
        return view('kategoriProduk.edit', ['kategori_produks' => Kategori_produk::find($id_kategori)]);
    }

    public function update(Request $request, string $id_kategori)
    {

        $validatedData = $request->validate([
            'nama_kategori' => 'required',
            
        ]);
        Kategori_produk::where('id_kategori', $id_kategori)->update($validatedData);
        return redirect('/kategori-produk')->with('pesan', 'Data success updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kategori)
    {
        Kategori_produk::destroy($id_kategori);
        return redirect('/kategori-produk')->with('pesan', 'Data succsess deleted');
    }
}
