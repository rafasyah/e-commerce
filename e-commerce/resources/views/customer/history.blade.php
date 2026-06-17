@extends('layouts.app')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
    {{ session('error') }}
</div>
@endif

<h1 class="text-3xl font-bold mb-8">
    Riwayat Belanja
</h1>

<div class="space-y-6">

@foreach($transactions as $transaction)

<div class="bg-white rounded-2xl shadow-lg p-6 flex justify-between items-center">

    <div>

        <h2 class="text-xl font-bold">
            {{ $transaction->product->nama_barang }}
        </h2>

        <p class="text-gray-500 mt-2">
            Jumlah: {{ $transaction->jumlah }}
        </p>

        <p class="text-gray-600 mt-1">
            Pembayaran: {{ ucfirst($transaction->jenis_pembayaran) }}
        </p>

        <p class="text-orange-500 font-bold mt-2">
            Rp {{ number_format($transaction->total_harga) }}
        </p>

    </div>

    <div>

        <span class="bg-orange-100 text-orange-600 px-5 py-3 rounded-xl font-semibold">
            {{ $transaction->orderUpdate->status }}
        </span>

    </div>

</div>

@endforeach

</div>

@endsection