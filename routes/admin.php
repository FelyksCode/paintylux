<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group(['middleware' => ['admin', 'verified'], 'prefix' => 'admin'], function () {
    // Index
    Volt::route('/', 'admin.index')
        ->name('admin');

    // Orders
    Volt::route('order', 'admin.orders')
        ->name('admin.orders');

    // Messages
    Volt::route('pesan', 'admin.messages')
        ->name('admin.messages');

    // Products
    Route::prefix('produk')->group(function () {
        Volt::route('/', 'admin.products.index')
            ->name('admin.products');
        Route::prefix('edit')->group(function () {
            Volt::route('warna/{id}', 'admin.products.edit.color')
                ->name('admin.products.edit.color');
            Volt::route('tipe/{id}', 'admin.products.edit.type')
                ->name('admin.products.edit.type');
            Volt::route('kategori/{id}', 'admin.products.edit.category')
                ->name('admin.products.edit.category');
        });
    });

    // Projects
    Route::prefix('proyek')->group(function () {
        Volt::route('/', 'admin.projects.index')
            ->name('admin.projects');
        Volt::route('edit/{id}', 'admin.projects.edit')
            ->name('admin.projects.edit');
    });

    // Users
    Volt::route('user', 'admin.users')
        ->name('admin.users');
});
