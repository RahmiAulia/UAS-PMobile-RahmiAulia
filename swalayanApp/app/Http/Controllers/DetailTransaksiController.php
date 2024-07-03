<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index (){
        return view('detailTransaksi.index', ['detail_transaksis' => Detail_transaksi::paginate(10) ]);
    }
}
