<?php
use App\Models\Color;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\Order;

use function Livewire\Volt\{layout};

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

    <section
        class="flex flex-col space-y-10 min-[800px]:flex-row min-[800px]:justify-between min-[800px]:space-x-10 min-[800px]:space-y-0">
        <section class="w-full space-y-10">
            <livewire:admin.products.create-color-form />
            <livewire:admin.products.create-type-form />
            <livewire:admin.products.create-category-form />
        </section>

        <!-- Color -->
        <section class="w-full space-y-10">
            <livewire:admin.products.color />
            <livewire:admin.products.type />
            <livewire:admin.products.category />
        </section>
    </section>
</section>
