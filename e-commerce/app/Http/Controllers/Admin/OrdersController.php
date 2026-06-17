<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $transactions = Transactions::with('product', 'orderUpdate')->latest()->get();

        return view('admin.orders.index', compact('transactions'));
    }
}
