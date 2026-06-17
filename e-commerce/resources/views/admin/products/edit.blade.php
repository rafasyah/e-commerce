@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <h1 class="text-3xl font-bold mb-8">
        Edit Produk
    </h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Nama Barang
            </label>
            <input
                type="text"
                name="nama_barang"
                value="{{ $product->nama_barang }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Deskripsi
            </label>
            <textarea
                name="deskripsi"
                rows="4"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
            >{{ $product->deskripsi }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Harga
            </label>
            <input
                type="number"
                name="harga"
                step="0.01"
                value="{{ $product->harga }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Stok
            </label>
            <input
                type="number"
                name="stok"
                value="{{ $product->stok }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Gambar Produk Saat Ini
            </label>
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_barang }}" class="w-32 h-32 object-cover rounded-lg mb-2">
            <p class="text-sm text-gray-500">Upload gambar baru untuk mengganti (opsional)</p>
            <input
                type="file"
                name="gambar"
                accept="image/*"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Jenis Pembayaran
            </label>
            <select
                name="jenis_pembayaran"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
            >
                <option value="cod" {{ $product->jenis_pembayaran == 'cod' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                <option value="transfer" {{ $product->jenis_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button
                type="submit"
                class="bg-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-600 transition"
            >
                Update Produk
            </button>

            <a
                href="{{ route('products.index') }}"
                class="bg-gray-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-600 transition"
            >
                Batal
            </a>
        </div>

    </form>

</div>

@endsection