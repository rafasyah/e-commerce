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

<div class="flex justify-between items-center mb-8">

    <h1 class="text-3xl font-bold">
        Daftar Pesanan
    </h1>

</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

<table class="w-full">

<thead class="bg-orange-500 text-white">
<tr>
    <th class="p-4">ID Transaksi</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Pembayaran</th>
    <th>Total</th>
    <th>Status</th>
    <th>Update Status</th>
</tr>
</thead>

<tbody>

@foreach($transactions as $transaction)

<tr class="border-b border-gray-200 hover:bg-gray-50">
    <td class="p-4 font-semibold">#{{ $transaction->id }}</td>
    <td class="p-4">{{ $transaction->product->nama_barang }}</td>
    <td class="p-4">{{ $transaction->jumlah }}</td>
<td class="p-4">
    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-lg text-sm">
        {{ ucfirst($transaction->product->jenis_pembayaran) }}
    </span>
</td>
    <td class="p-4">Rp {{ number_format($transaction->total_harga) }}</td>
    <td class="p-4">
        <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-lg">
            {{ $transaction->orderUpdate->status }}
        </span>
    </td>
    <td class="p-4">

        <form
            action="{{ route('order.update', $transaction->orderUpdate->id) }}"
            method="POST"
            class="flex gap-2"
        >
            @csrf
            @method('PUT')

            <select
                name="status"
                class="border p-2 rounded-lg text-sm"
            >
                <option value="proses" {{ $transaction->orderUpdate->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="packing" {{ $transaction->orderUpdate->status == 'packing' ? 'selected' : '' }}>Packing</option>
                <option value="pengantaran" {{ $transaction->orderUpdate->status == 'pengantaran' ? 'selected' : '' }}>Pengantaran</option>
                <option value="selesai" {{ $transaction->orderUpdate->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-orange-600">
                Update
            </button>

        </form>

    </td>
</tr>
@endforeach

</tbody>

</table>

</div>

@endsection