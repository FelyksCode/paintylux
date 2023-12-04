<?php

use App\Models\Color;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\Order;

use function Livewire\Volt\layout;

layout('layouts.admin');

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <div class="text-5xl font-light tracking-tighter">
            {{ __('Produk') }}
        </div>
        <div class="text-inactive text-xl">
            {{ __('Kelola warna, tipe, dan kategori produk.') }}
        </div>
    </section>

    <!-- Summary -->
    <section class="space-y-4">

    </section>
</section>
