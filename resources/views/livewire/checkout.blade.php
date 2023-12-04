<?php

use App\Models\OrderDetail;
use App\Models\Order;

use function Livewire\Volt\layout;

layout('layouts.app');

$send = function () {
    $validated = $this->validate();
};

?>

<section
    class="std-section flex flex-col items-center space-y-10 min-[1280px]:flex-row min-[1280px]:space-x-12 min-[1280px]:space-y-0">
    {{-- Orders --}}
    <section class="flex w-full flex-col space-y-6 min-[1280px]:w-[60%]">
        {{-- Header --}}
        <x-header-count :title="__('Checkout')" :count="0" />
        <hr class="border-[rgb(var(--fg-rgb))]">

        {{-- List --}}
        <div class="text-inactive text-xl">
            {{ __('Anda belum melakukan pemesanan.') }}
            <br>
            <a href="{{ route('products') }}" class="text-link">{{ __('Lihat produk kami') }}</a> untuk mulai memesan.
        </div>
    </section>

    {{-- Summary --}}
    <section
        class="flex w-full flex-col space-y-6 rounded-xl bg-[rgb(var(--fg-rgb))] px-8 py-6 text-[rgb(var(--bg-rgb))] min-[1280px]:w-[40%]">
        <div class="text-upperwide text-2xl font-bold">
            Total
        </div>
        <div class="text-upperwide flex w-full items-center justify-between">
            <div>IDR</div>
            <div>0,00</div>
        </div>
    </section>
</section>
