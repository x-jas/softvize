<?php

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('api')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'display']);

    Route::post('/add-product', [ProductController::class, 'add']);
    Route::post('/add-discount', [DiscountController::class, 'add']);
});
