<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index (){
        return view('pengguna.index', ['penggunas' => Pengguna::paginate(10)]);
    }

    public function destroy(string $id_pengguna)
    {
        Pengguna::destroy($id_pengguna);
        return redirect('/ulasan')->with('pesan', 'Data succsess deleted');
    }
}
