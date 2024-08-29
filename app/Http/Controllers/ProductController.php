<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

  public function indexApi(Request $request)
    {
        $products = Product::all();

        return view('compra.api', compact('products'));
    }

    public function indexLocal(Request $request)
    {
        $products = Product::all();

        return view('compra.local', compact('products'));
    }
}
