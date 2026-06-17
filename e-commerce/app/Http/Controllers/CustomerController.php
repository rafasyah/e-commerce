<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $products = Products::latest()->get();

        return view('customer.index', compact('products'));
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);

        return view('customer.products.show', compact('product'));
    }
}
