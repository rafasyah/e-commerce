<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Products::count();
        $totalPesanan = Transactions::count();
        $totalPendapatan = Transactions::where('status_pembayaran', 'paid')->sum('total_harga');

        return view('admin.dashboard', compact('totalProduk', 'totalPesanan', 'totalPendapatan'));
    }
}
