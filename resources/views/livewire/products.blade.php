<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Color;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderDetail;

use function Livewire\Volt\{layout, mount, state, rules, placeholder, computed};

use Masmerise\Toaster\Toaster;

layout('layouts.app');

state([
    'type' => fn($slug) => ProductType::findBySlug($slug),
    'categories' => '',
    'product_category_id' => '',
    'color_id' => '',
    'price' => 0,
    'hex' => '',
])->locked();

state(['quantity' => 1]);

$colors = computed(function () {
    return Color::allOrdered();
});

mount(function () {
    $this->categories = $this->type->categories();
});

rules([
    'quantity' => ['required', 'integer', 'min:1'],
    'color_id' => ['required', 'integer', 'exists:App\Models\Color,id'],
    'product_category_id' => ['required', 'integer', 'exists:App\Models\ProductCategory,id'],
])->messages([
    'quantity.required' => 'Mohon mengisi jumlah yang ingin dipesan.',
    'quantity.integer' => 'Mohon mengisi jumlah yang valid.',
    'quantity.min' => 'Jumlah yang ingin dipesan minimal 1.',
    'color_id.required' => 'Mohon memilih warna.',
    'color_id.integer' => 'Mohon memilih warna yang valid.',
    'color_id.exists' => 'Mohon memilih warna yang valid.',
    'product_category_id.required' => 'Mohon memilih kategori.',
    'product_category_id.integer' => 'Mohon memilih kategori yang valid.',
    'product_category_id.exists' => 'Mohon memilih kategori yang valid.',
]);

// placeholder('
//     <div role="status" class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
//         <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
//             <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
//                 <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
//             </svg>
//         </div>
//         <div class="w-full">
//             <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
//             <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[480px] mb-2.5"></div>
//             <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
//             <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[440px] mb-2.5"></div>
//             <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[460px] mb-2.5"></div>
//             <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
//         </div>
//         <span class="sr-only">Loading...</span>
//     </div>
// ');

$select_category = function ($id, $price) {
    $this->product_category_id = $id;
    $this->price = $price;
    $this->validate(['product_category_id' => ['required', 'integer', 'exists:App\Models\ProductCategory,id']]);
};

$select_color = function ($id, $hex) {
    $this->color_id = $id;
    $this->hex = $hex;
    $this->validate(['color_id' => ['required', 'integer', 'exists:App\Models\Color,id']]);
};

$order = function () {
    // Redirect to login if not authenticated
    if (!Auth::check()) {
        Session::put('url.intended', route('products.type', ['slug' => $this->type->slug()]));
        return $this->redirect(route('login'), navigate: true);
    }

    // Do nothing if admin
    if (Auth::check() && Auth::user()->is_admin) {
        return;
    }

    // Validate
    $validated = $this->validate();

    // Add order
    OrderDetail::addOrder($this->quantity, $this->product_category_id, $this->color_id);

    // Dispatch event
    $this->dispatch('order-updated');
    Toaster::success('Ditambah ke keranjang!');

    // Clear states
    $this->product_category_id = '';
    $this->color_id = '';
    $this->price = '';
    $this->hex = '';
    $this->quantity = 1;
};

?>

<x-slot:title>{{ $type->name }}</x-slot>

<section class="std-section overflow-x-hidden py-6">
    <div class="flex items-center space-x-4">
        <x-icons.back-button :link="route('products')" class="h-11 w-11" />
        <h2 class="text-5xl font-light tracking-tighter text-gray-800">
            {{ __($type->name) }}
        </h2>
    </div>
    <div class="flex flex-col space-y-10 min-[1000px]:flex-row min-[1000px]:space-x-10 min-[1000px]:space-y-0">
        <!-- Image -->
        <div class="relative mt-[100px] w-full min-[1000px]:w-1/2">
            <div class="float smooth absolute -top-[30px] left-0 z-[-1] flex aspect-square h-[150px] w-[150px] items-center justify-center rounded-full border border-[rgba(var(--fg-rgb),0.2)] text-7xl font-light [animation-duration:10s] min-[350px]:h-[250px] min-[350px]:w-[250px] min-[350px]:text-8xl min-[500px]:h-[350px] min-[500px]:w-[350px] min-[500px]:text-9xl min-[750px]:left-[60px] min-[1000px]:left-0 min-[1350px]:-left-[30px]"
                style="background-color: {{ $this->hex ? "#{$this->hex}" : 'transparent' }}">
                @unless ($this->color_id)
                    <span class="opacity-30">?</span>
                @endunless
            </div>
            <img src="{{ asset(Storage::url($type->image)) }}" alt="{{ $type->name }}"
                class="float h-[250px] w-full object-scale-down min-[350px]:h-[300px] min-[500px]:h-[350px] min-[1350px]:h-[400px]">
        </div>

        <div class="w-full space-y-10 min-[1000px]:-mt-[50px] min-[1000px]:w-1/2">
            <!-- Price -->
            <div class="text-3xl min-[350px]:text-4xl min-[500px]:text-5xl">
                {{ format_price((float) $this->price * (int) $this->quantity) }}
            </div>

            <!-- Quantity -->
            <div class="space-y-3 font-medium">
                <div class="text-upperwide text-xl font-medium">{{ __('Jumlah') }}</div>
                <x-text-input wire:model.live="quantity" id="quantity" name="quantity" type="number"
                    class="mt-1 block w-full" />

                @if (Auth::check() && Auth::user()->is_admin)
                    <div class="text-upperwide text-inactive opacity-75">Admin tidak dapat memesan</div>
                @else
                    <!-- Order -->
                    <div class="space-y-4">
                        <x-primary-button wire:click="order">{{ __('Order') }}</x-primary-button>
                        <div>
                            <x-input-error :messages="$errors->get('quantity')" />
                            <x-input-error :messages="$errors->get('product_category_id')" />
                            <x-input-error :messages="$errors->get('color_id')" />
                        </div>
                    </div>
                @endif
            </div>
            <hr class="border-[rgb(var(--fg-rgb))]">

            <!-- Category -->
            <div class="space-y-3 font-medium">
                <x-header-count :title="__('Pilih kategori')" :count="$this->categories->count()" small />
                <div class="flex items-center space-x-6">
                    @foreach ($this->categories as $category)
                        <button wire:click="select_category({{ $category->id }}, {{ $category->price }})"
                            class="smooth @if ($this->product_category_id === $category->id) bg-[rgb(var(--fg-rgb))] text-[rgb(var(--bg-rgb))] @else bg-transparent @endif w-full rounded-md border border-[rgb(var(--fg-rgb))] p-2 text-xl font-light tracking-tight hover:opacity-75">
                            {{ $category->container }} {{ $category->weight }} kg
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Colors -->
            <div class="space-y-6 font-medium">
                <x-header-count :title="__('Pilih warna')" :count="$this->colors->count()" small />
                <div
                    class="grid grid-cols-6 gap-4 min-[600px]:grid-cols-10 min-[750px]:grid-cols-12 min-[1000px]:grid-cols-8 min-[1000px]:grid-cols-8 min-[1250px]:grid-cols-10">
                    @foreach ($this->colors as $color)
                        <button wire:click="select_color({{ $color->id }}, '{{ $color->hex }}')"
                            class="@if ($this->color_id === $color->id) ring-2 ring-offset-2 ring-[rgba(var(--fg-rgb),0.4)] @endif smooth aspect-square h-[50px] w-[50px] cursor-pointer rounded-full shadow-md shadow-[rgba(var(--fg-rgb),0.3)] hover:scale-105"
                            style="background-color: #{{ $color->hex }}"></button>
                    @endforeach
                </div>
                @empty($this->colors)
                    <div class="text-inactive">
                        {{ __('Belum ada warna.') }}</div>
                @endempty
            </div>
        </div>

    </div>
    </div>
</section>
