<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // tampil semua produk
    public function index()
    {
        $products = Products::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    // form tambah produk
    public function create()
    {
        return view('admin.products.create');
    }

    // simpan produk
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required|image'
        ]);

        $gambar = $request->file('gambar')->store('products', 'public');

        Products::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambar
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // form edit
    public function edit(Products $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // update produk
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image'
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

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    // hapus produk
    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}