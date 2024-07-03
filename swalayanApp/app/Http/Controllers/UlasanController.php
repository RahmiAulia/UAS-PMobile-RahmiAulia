<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index(){
        return view('ulasan.index', ['ulasans' => Ulasan::paginate(10)]);
    }

    // public function update(Request $request, string $id_ulasan)
    // {
        
    //     $validatedData = $request->validate([
    //         'id_produk' => 'required',
    //         'id_pengguna' => 'required',
    //         'ulasan' =>'required',
    //         'rating' =>'required'
            
    //     ]);
        
    //     Ulasan::where('id_ulasan', $id_ulasan)->update($validatedData);
    //     return redirect('/ulasan')->with('pesan', 'Data success updated');dd($validatedData);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_ulasan)
    {
        Ulasan::destroy($id_ulasan);
        return redirect('/ulasan')->with('pesan', 'Data succsess deleted');
    }
}
