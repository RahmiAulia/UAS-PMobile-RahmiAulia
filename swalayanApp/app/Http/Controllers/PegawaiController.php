<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('users.index', ['users' => User::paginate(10)]);
    }

    public function create()
    {
        return view('users.create', ['users' => User::all()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required'        
        ]);
        User::create($validatedData);
        return redirect('/pegawai')->with('pesan', 'Data Saved');
    }

    public function edit(string $id)
    {
        return view('users.edit', [
            'users' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        User::where('id', $id)->update($validatedData);
        return redirect('/pegawai')->with('pesan', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect('/pegawai')->with('pesan', 'Data Berhasil di Hapus');
    }
}
