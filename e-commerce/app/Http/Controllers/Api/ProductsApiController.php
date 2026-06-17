<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsApiController extends Controller
{
    public function index()
    {
        $products = Products::latest()->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required|image',
            'jenis_pembayaran' => 'required|in:cod,transfer'
        ]);

        $gambar = $request->file('gambar')->store('products', 'public');

        $product = Products::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambar,
            'jenis_pembayaran' => $request->jenis_pembayaran
        ]);

        return response()->json($product, 201);
    }

    public function show(Products $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image',
            'jenis_pembayaran' => 'required|in:cod,transfer'
        ]);

        $data = [
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('products', 'public');
            $data['gambar'] = $gambar;
        }

        $data['jenis_pembayaran'] = $request->jenis_pembayaran;

        $product->update($data);

        return response()->json($product);
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}