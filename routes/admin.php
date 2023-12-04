<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Volt::route('/', 'admin.index')
        ->name('admin');
    Volt::route('order', 'admin.orders')
        ->name('admin-orders');
    Volt::route('pesan', 'admin.messages')
        ->name('admin-messages');
    Volt::route('produk', 'admin.products')
        ->name('admin-products');
    Volt::route('proyek', 'admin.projects')
        ->name('admin-projects');
    Volt::route('user', 'admin.users')
        ->name('admin-users');
});
