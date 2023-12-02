<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::view('/', 'admin.index')
        ->name('admin');
});
