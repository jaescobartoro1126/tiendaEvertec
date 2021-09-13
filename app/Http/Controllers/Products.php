<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Products extends Controller
{
    public function index()
    {
        return view('products', [
            'products' => Product::get()
        ]);
    }
}
