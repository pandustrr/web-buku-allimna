<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('produk-detail', [
            'product' => $product,
            'isLoggedIn' => Auth::check()
        ]);
    }
}
