<?php

use App\Models\Order;
use App\Models\OrderDetail;

use function Livewire\Volt\layout;

layout('layouts.admin');

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <x-header-count :title="__('Order')" :count="count(Order::all())" />
        <div class="text-inactive text-xl">
            {{ __('Kelola order yang masuk.') }}
        </div>
    </section>
</section>
