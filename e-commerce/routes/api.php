<?php

use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TransactionsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

// Public routes
Route::get('/products', [ProductsApiController::class, 'index']);
Route::get('/products/{product}', [ProductsApiController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/products', [ProductsApiController::class, 'store']);
    Route::put('/products/{product}', [ProductsApiController::class, 'update']);
    Route::delete('/products/{product}', [ProductsApiController::class, 'delete']);
    Route::apiResource('/transactions', TransactionsApiController::class);
});
