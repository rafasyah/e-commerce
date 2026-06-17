<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\Products;
use Illuminate\Http\Request;

class TransactionsApiController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->with('product')->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Products::find($request->product_id);

        if ($product->stok < $request->quantity) {
            return response()->json(['error' => 'Insufficient stock'], 400);
        }

        $total = $product->harga * $request->quantity;

        $transaction = Transactions::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        $product->decrement('stok', $request->quantity);

        return response()->json($transaction, 201);
    }

    public function show(Transactions $transaction)
    {
        // Ensure user owns the transaction
        if ($transaction->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($transaction->load('product'));
    }

    public function update(Request $request, Transactions $transaction)
    {
        // For updating status, perhaps admin only, but for now, allow user to cancel or something
        // Simplified: assume only status update
        if ($transaction->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $transaction->update(['status' => $request->status]);

        return response()->json($transaction);
    }
}