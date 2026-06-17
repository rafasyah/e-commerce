@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Semua Produk
</h1>

<div class="grid grid-cols-2 md:grid-cols-5 gap-6">

@foreach($products as $product)

<div class="bg-white rounded-2xl overflow-hidden shadow card-hover">

    <img
        src="{{ asset('storage/' . $product->gambar) }}"
        class="w-full h-52 object-cover"
    >

    <div class="p-4">

        <h2 class="font-semibold text-lg line-clamp-2">
            {{ $product->nama_barang }}
        </h2>

        <p class="text-orange-500 font-bold text-xl mt-2">
            Rp {{ number_format($product->harga) }}
        </p>

        <p class="text-gray-500 mt-1">
            Stok: {{ $product->stok }}
        </p>

        <a
            href="/products/{{ $product->id }}"
            class="block mt-4 bg-orange-500 text-white text-center py-2 rounded-xl hover:bg-orange-600"
        >
            Lihat Detail
        </a>

    </div>

</div>

@endforeach

</div>

@endsection