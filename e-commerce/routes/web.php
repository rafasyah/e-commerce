<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderUpdatesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer routes
Route::middleware('auth')->group(function () {
    Route::get('/products', [CustomerController::class, 'index'])->name('customer.products');
    Route::get('/products/{id}', [CustomerController::class, 'show'])->name('customer.product.show');
    Route::post('/checkout/{id}', [TransactionsController::class, 'checkout'])->name('checkout');
    Route::get('/history', [TransactionsController::class, 'history'])->name('customer.history');
});

// Admin routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductsController::class);
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');
    Route::put('/status/{id}', [OrderUpdatesController::class, 'update'])->name('order.update');
});

require __DIR__.'/auth.php';
