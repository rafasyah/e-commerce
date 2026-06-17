@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Dashboard Admin
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-gray-500 text-lg">Total Produk</h2>
        <p class="text-4xl font-bold text-orange-500 mt-4">
            {{ $totalProduk }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-gray-500 text-lg">Total Pesanan</h2>
        <p class="text-4xl font-bold text-blue-500 mt-4">
            {{ $totalPesanan }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-gray-500 text-lg">Total Pendapatan</h2>
        <p class="text-4xl font-bold text-green-500 mt-4">
            Rp {{ number_format($totalPendapatan) }}
        </p>
    </div>

</div>

<div class="mt-12">
    <h2 class="text-2xl font-bold mb-6">Quick Actions</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <a
            href="{{ route('products.index') }}"
            class="bg-orange-500 text-white p-6 rounded-2xl shadow-lg hover:bg-orange-600 transition text-center"
        >
            <div class="text-3xl mb-2">📦</div>
            <h3 class="font-semibold">Manage Products</h3>
            <p class="text-sm opacity-90">Add, edit, or delete products</p>
        </a>

        <a
            href="#"
            class="bg-blue-500 text-white p-6 rounded-2xl shadow-lg hover:bg-blue-600 transition text-center"
        >
            <div class="text-3xl mb-2">📋</div>
            <h3 class="font-semibold">View Orders</h3>
            <p class="text-sm opacity-90">Manage customer orders</p>
        </a>

        <a
            href="#"
            class="bg-green-500 text-white p-6 rounded-2xl shadow-lg hover:bg-green-600 transition text-center"
        >
            <div class="text-3xl mb-2">📊</div>
            <h3 class="font-semibold">Reports</h3>
            <p class="text-sm opacity-90">View sales reports</p>
        </a>

        <a
            href="#"
            class="bg-purple-500 text-white p-6 rounded-2xl shadow-lg hover:bg-purple-600 transition text-center"
        >
            <div class="text-3xl mb-2">⚙️</div>
            <h3 class="font-semibold">Settings</h3>
            <p class="text-sm opacity-90">Configure your store</p>
        </a>

    </div>
</div>

@endsection