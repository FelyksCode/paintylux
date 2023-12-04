<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'index')
    ->name('index');

Route::view('produk', 'products.index')
    ->name('products');

Route::view('proyek', 'projects.index')
    ->name('projects');

Volt::route('hubungi-kami', 'contact')
    ->name('contact');

Volt::route('checkout', 'checkout')
    ->middleware('auth')
    ->name('checkout');

Route::view('profile', 'profile.index')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::view('profile/edit', 'profile.edit')
    ->middleware(['auth', 'verified'])
    ->name('edit-profile');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
