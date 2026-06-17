@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <h1 class="text-3xl font-bold mb-8">
        Tambah Produk Baru
    </h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Nama Barang
            </label>
            <input
                type="text"
                name="nama_barang"
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
            ></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Harga
            </label>
            <input
                type="number"
                name="harga"
                step="0.01"
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
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Gambar Produk
            </label>
            <input
                type="file"
                name="gambar"
                accept="image/*"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                required
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
                <option value="">Pilih Jenis Pembayaran</option>
                <option value="cod">Cash on Delivery (COD)</option>
                <option value="transfer">Transfer Bank</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button
                type="submit"
                class="bg-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-600 transition"
            >
                Simpan Produk
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