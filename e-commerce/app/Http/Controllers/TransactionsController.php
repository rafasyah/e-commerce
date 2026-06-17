<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use App\Models\Order_Updates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    // checkout
    public function checkout(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $product = Products::findOrFail($id);

        $jumlah = $request->jumlah;

        if ($jumlah > $product->stok) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $total = $jumlah * $product->harga;

        $transaction = Transactions::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'jumlah' => $jumlah,
            'total_harga' => $total,
            'status_pembayaran' => 'pending',
            'jenis_pembayaran' => $product->jenis_pembayaran
        ]);

        // status awal
        Order_Updates::create([
            'transaction_id' => $transaction->id,
            'status' => 'proses'
        ]);

        // kurangi stok
        $product->stok -= $jumlah;
        $product->save();

        return redirect()->route('customer.history')
            ->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
    }

    // riwayat belanja
    public function history()
    {
        $transactions = Transactions::with('product', 'orderUpdate')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.history', compact('transactions'));
    }
}