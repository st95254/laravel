<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showGold()
    {
        $products = Product::where('product_type', 'gold')->get();
        return view('products.gold', compact('products'));
    }

    public function showTea()
    {
        $products = Product::where('product_type', 'tea')->get();
        return view('products.tea', compact('products'));
    }
}