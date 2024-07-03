<?php

namespace App\Http\Controllers;

use App\Models\Kategori_produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        return view('produk.index', ['produks' => Produk::paginate(10) ]);
    }

    public function create()
    {
        return view('produk.create', ['kategori_produks' => Kategori_produk::all()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' =>'required',
            'deskripsi' =>'required',
            'gambar_produk' =>'required'
        ]);

        Produk::create($validatedData);
        return redirect('/produk')->with('pesan', 'Data Saved');
    }

    public function edit(string $id_produk)
    {
        return view('produk.edit', [
            'produks' => Produk::find($id_produk),
            'kategori_produks' => Kategori_produk::all()
        ]);
    }

    public function update(Request $request, string $id_produk)
    {
        
        $validatedData = $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' =>'required',
            'deskripsi' =>'required',
            'gambar_produk' =>'required'
            
        ]);
        
        Produk::where('id_produk', $id_produk)->update($validatedData);
        return redirect('/produk')->with('pesan', 'Data success updated');dd($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_produk)
    {
        Produk::destroy($id_produk);
        return redirect('/produk')->with('pesan', 'Data succsess deleted');
    }
}
