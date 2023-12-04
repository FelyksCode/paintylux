<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group(['middleware' => ['admin', 'verified'], 'prefix' => 'admin'], function () {
    Volt::route('/', 'admin.index')
        ->name('admin');
    Volt::route('order', 'admin.orders')
        ->name('admin-orders');
    Volt::route('pesan', 'admin.messages')
        ->name('admin-messages');
    Route::prefix('produk')->group(function () {
        Volt::route('/', 'admin.products.index')
            ->name('admin-products');
    });
    Route::prefix('proyek')->group(function () {
        Volt::route('/', 'admin.projects.index')
            ->name('admin-projects');
        Volt::route('edit/{id}', 'admin.projects.edit')
            ->name('admin-projects.edit');
    });
    Volt::route('user', 'admin.users')
        ->name('admin-users');
});
