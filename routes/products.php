<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::prefix('produk')->group(function () {
    Route::view('/', 'products')
        ->name('products');
    Volt::route('{slug}', 'products')
        ->name('products.type');
});

Volt::route('checkout', 'checkout')
    ->middleware(['auth', 'non-admin'])
    ->name('checkout');
