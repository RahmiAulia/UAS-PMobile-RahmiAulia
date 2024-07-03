<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index (){
        return view('shipping.index', ['shippings' => Shipping::paginate(10) ]);
    }
}
