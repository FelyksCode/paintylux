<?php

use App\Models\Order;
use App\Models\OrderDetail;

use function Livewire\Volt\{layout, mount, state};

layout('layouts.admin');

state([
    'totalOrdersCount' => Order::confirmed()->count(),
    'ongoing' => Order::ongoing(),
    'finished' => Order::finished(),
    'allEarnings' => Order::allEarnings(),
    'allQuantity' => Order::allQuantity(),
    'allWeights' => Order::allWeights(),
    'ongoingEarnings' => Order::ongoingEarnings(),
    'ongoingQuantity' => Order::ongoingQuantity(),
    'ongoingWeights' => Order::ongoingWeights(),
    'finishedEarnings' => Order::finishedEarnings(),
    'finishedQuantity' => Order::finishedQuantity(),
    'finishedWeights' => Order::finishedWeights(),
])->locked();

$refresh = function () {
    $this->totalOrdersCount = Order::confirmed()->count();
    $this->ongoing = Order::ongoing();
    $this->finished = Order::finished();
    $this->allEarnings = Order::allEarnings();
    $this->allQuantity = Order::allQuantity();
    $this->allWeights = Order::allWeights();
    $this->ongoingEarnings = Order::ongoingEarnings();
    $this->ongoingQuantity = Order::ongoingQuantity();
    $this->ongoingWeights = Order::ongoingWeights();
    $this->finishedEarnings = Order::finishedEarnings();
    $this->finishedQuantity = Order::finishedQuantity();
    $this->finishedWeights = Order::finishedWeights();
};

$delete = function ($id) {
    Order::find($id)->delete();
    $this->dispatch('close');
    $this->refresh();
};

$toggleFinish = function ($id) {
    $order = Order::find($id);
    $order->finished = !$order->finished;
    $order->finished_at = $order->finished ? now() : null;
    $order->save();

    // Update states
    $this->ongoing = Order::ongoing();
    $this->finished = Order::finished();
    $this->ongoingEarnings = Order::ongoingEarnings();
    $this->ongoingQuantity = Order::ongoingQuantity();
    $this->ongoingWeights = Order::ongoingWeights();
    $this->finishedEarnings = Order::finishedEarnings();
    $this->finishedQuantity = Order::finishedQuantity();
    $this->finishedWeights = Order::finishedWeights();
};

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <x-header-count :title="__('Order')" :count="$this->totalOrdersCount" />
        <div class="text-inactive text-xl">
            {{ __('Kelola order yang masuk.') }}
        </div>
    </section>

    <!-- Summary -->
    <section class="space-y-4">
        <div class="text-upperwide text-xl">{{ __('Rincian') }}</div>
        <div
            class="space-y-4 rounded-lg bg-[rgb(var(--blue-rgb))] px-6 py-6 text-[rgb(var(--white-rgb))] min-[400px]:px-10">
            <!-- Finished summary -->
            <div class="grid gap-4 min-[1100px]:grid-cols-3">
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Pemasukan selesai') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ format_price($this->finishedEarnings) }}
                    </div>
                </div>
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Jumlah selesai terjual') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ $this->finishedQuantity }}
                    </div>
                </div>
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Berat selesai terjual') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ $this->finishedWeights }} kg
                    </div>
                </div>
            </div>
            <hr class="border-[rgb(var(--white-rgb))]">

            <!-- Ongoing summary -->
            <div class="grid gap-4 min-[1100px]:grid-cols-3">
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Pemasukan diproses') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ format_price($this->ongoingEarnings) }}
                    </div>
                </div>
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Jumlah diproses terjual') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ $this->ongoingQuantity }}
                    </div>
                </div>
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Berat diproses terjual') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ $this->ongoingWeights }} kg
                    </div>
                </div>
            </div>
            <hr class="border-[rgb(var(--white-rgb))]">

            <!-- Overall summary -->
            <div class="grid gap-4 min-[1100px]:grid-cols-3">
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Pemasukan keseluruhan') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ format_price($this->allEarnings) }}
                    </div>
                </div>
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Jumlah keseluruhan terjual') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ $this->allQuantity }}
                    </div>
                </div>
                <div>
                    <div
                        class="text-upperwide text-sm font-medium text-[rgba(var(--white-rgb),0.6)] min-[400px]:text-base">
                        {{ __('Berat keseluruhan terjual') }}
                    </div>
                    <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                        {{ $this->allWeights }} kg
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ongoing orders -->
    <section class="space-y-4">
        <x-header-count :title="__('Belum Diproses')" :count="$this->ongoing->count()" small />
        @forelse ($this->ongoing as $order)
            <x-admin.summary-box
                class="flex flex-col space-y-8 px-6 min-[400px]:px-10 min-[850px]:flex-row min-[850px]:items-center min-[850px]:justify-between min-[850px]:space-y-0">
                <div
                    class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-10 min-[850px]:space-y-0">
                    <div class="space-y-3">
                        <div>
                            <div class="text-xl font-bold">{{ $order->user->name }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $order->user->email }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $order->totalQuantity() }} produk,
                                {{ $order->totalWeight() }} kg</div>
                        </div>
                        <div>
                            <div class="text-upperwide text-sm opacity-80">
                                {{ __('Waktu Pemesanan') }}
                            </div>
                            <div class="text-upperwide text-sm font-bold">
                                {{ get_timestamp($order->confirmed_at) }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden h-[100px] border-r border-r-[rgb(var(--fg-rgb))] min-[850px]:block"></div>
                    <hr class="block border-[rgb(var(--fg-rgb))] min-[850px]:hidden">
                    <div class="space-y-3">
                        <div class="text-upperwide text-xl font-bold min-[400px]:text-2xl">
                            {{ format_price($order->totalSum()) }}
                        </div>
                        <div class="space-y-1">
                            @foreach ($order->orderDetails->get() as $detail)
                                <div class="flex items-center space-x-2">
                                    <div class="aspect-square h-[20px] w-[20px] rounded-full border border-[rgba(var(--white-rgb),0.4)]"
                                        style="background-color: #{{ $detail->color->hex }}"></div>
                                    <div>{{ $detail->name() }} <span class="font-bold">({{ $detail->quantity }} x
                                            {{ format_price($detail->category->price, $prefix = false) }})
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4 min-[850px]:flex-col min-[850px]:space-x-0 min-[850px]:space-y-3">
                    <x-icons.delete-button
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-order-{{ $order->id }}-deletion')" />
                    <x-icons.finish-button wire:click="toggleFinish({{ $order->id }})" />
                </div>
            </x-admin.summary-box>
            <x-modal name="confirm-order-{{ $order->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus order ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $order->id }})">
                            {{ __('Hapus Order') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada order yang masuk.') }}</div>
        @endforelse
    </section>

    <!-- Finished orders -->
    <section class="space-y-4">
        <x-header-count :title="__('Selesai')" :count="$this->finished->count()" small />
        @forelse ($this->finished as $order)
            <x-admin.summary-box light
                class="flex flex-col space-y-8 min-[850px]:flex-row min-[850px]:items-center min-[850px]:justify-between min-[850px]:space-y-0">
                <div
                    class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-10 min-[850px]:space-y-0">
                    <div class="space-y-3">
                        <div>
                            <div class="text-xl font-bold">{{ $order->user->name }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $order->user->email }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $order->totalQuantity() }} produk,
                                {{ $order->totalWeight() }} kg</div>
                        </div>
                        <div>
                            <div class="text-upperwide text-sm opacity-80">
                                {{ __('Waktu Pemesanan') }}
                            </div>
                            <div class="text-upperwide text-sm font-bold">
                                {{ get_timestamp($order->confirmed_at) }}
                            </div>
                        </div>
                        <div>
                            <div class="text-upperwide text-sm opacity-80">
                                {{ __('Waktu Selesai') }}
                            </div>
                            <div class="text-upperwide text-sm font-bold">
                                {{ get_timestamp($order->finished_at) }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden h-[100px] border-r border-r-[rgb(var(--black-rgb))] min-[850px]:block"></div>
                    <hr class="block border-[rgb(var(--black-rgb))] min-[850px]:hidden">
                    <div class="space-y-3">
                        <div class="text-upperwide text-2xl font-bold">
                            {{ format_price($order->totalSum()) }}
                        </div>
                        <div class="space-y-1">
                            @foreach ($order->orderDetails->get() as $detail)
                                <div class="flex items-center space-x-2">
                                    <div class="aspect-square h-[20px] w-[20px] rounded-full border border-[rgba(var(--black-rgb),0.2)]"
                                        style="background-color: #{{ $detail->color->hex }}"></div>
                                    <div>{{ $detail->name() }} <span class="font-bold">({{ $detail->quantity }} x
                                            {{ format_price($detail->category->price, $prefix = false) }})
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4 min-[850px]:flex-col min-[850px]:space-x-0 min-[850px]:space-y-3">
                    <x-icons.delete-button
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-order-{{ $order->id }}-deletion')" />
                    <x-icons.finish-button wire:click="toggleFinish({{ $order->id }})" finished />
                </div>
            </x-admin.summary-box>
            <x-modal name="confirm-order-{{ $order->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus order ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $order->id }})">
                            {{ __('Hapus Order') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada order yang sudah diselesaikan.') }}</div>
        @endforelse
    </section>
</section>
