@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

    <h1 class="text-3xl font-bold">
        Manajemen Produk
    </h1>

    <a
        href="{{ route('products.create') }}"
        class="bg-orange-500 text-white px-6 py-3 rounded-xl"
    >
        + Tambah Produk
    </a>

</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

<table class="w-full">

<thead class="bg-orange-500 text-white">
<tr>
    <th class="p-4">Gambar</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($products as $product)
<tr class="border-b border-gray-200 hover:bg-gray-50">
    <td class="p-4">
        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_barang }}" class="w-16 h-16 object-cover rounded-lg">
    </td>
    <td class="p-4 font-semibold">{{ $product->nama_barang }}</td>
    <td class="p-4">Rp {{ number_format($product->harga) }}</td>
    <td class="p-4">{{ $product->stok }}</td>
    <td class="p-4">
        <div class="flex gap-2">
            <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm" onclick="return confirm('Yakin hapus produk?')">Hapus</button>
            </form>
        </div>
    </td>
</tr>
@endforeach

</tbody>

</table>

</div>

@endsection