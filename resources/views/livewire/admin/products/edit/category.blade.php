<?php

use App\Models\ProductCategory;
use App\Models\ProductType;

use function Livewire\Volt\{mount, layout, rules, state};

state(['category' => fn($id) => ProductCategory::findOrFail($id)])->locked();

state(['price', 'weight', 'container', 'product_type_id']);

mount(function () {
    $this->price = $this->category->price;
    $this->weight = $this->category->weight;
    $this->container = $this->category->container;
    $this->product_type_id = $this->category->product_type_id;
});

rules([
    'price' => ['required', 'decimal:0,2', 'min:0'],
    'weight' => ['required', 'integer', 'min:0'],
    'container' => ['required', 'string', 'max:50'],
    'product_type_id' => ['required', 'integer', 'exists:App\Models\ProductType,id'],
])->messages([
    'price.required' => 'Mohon mengisi harga.',
    'price.decimal' => 'Mohon mengisi harga yang valid.',
    'price.min' => 'Mohon mengisi harga yang valid.',
    'weight.required' => 'Mohon mengisi berat.',
    'weight.decimal' => 'Mohon mengisi berat yang valid.',
    'weight.min' => 'Mohon mengisi berat yang valid.',
    'container.required' => 'Mohon mengisi nama kontainer.',
    'container.max' => 'Nama kontainer yang diisi terlalu panjang.',
    'product_type_id.required' => 'Mohon memilih tipe.',
    'product_type_id.integer' => 'Mohon memilih tipe yang valid.',
    'product_type_id.exists' => 'Mohon memilih tipe yang valid.',
]);

layout('layouts.admin');

$update = function () {
    // Validate
    $validated = $this->validate();

    // Update category
    $this->category->update($validated);

    // Redirect back to index
    return $this->redirect(route('admin.products'), navigate: true);
};

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <div class="flex items-center space-x-4">
            <x-icons.back-button :link="route('admin.products')" class="h-11 w-11" />
            <div>
                <div class="text-4xl font-light tracking-tighter min-[600px]:text-5xl">{{ __('Edit Kategori ') }}<strong
                        class="font-bold">{{ $this->category->type->name }} {{ $this->container }} {{ $this->weight }}
                        kg</strong></div>
                <div class="text-inactive text-lg min-[600px]:text-xl">
                    {{ __('Ubah informasi mengenai warna ini.') }}
                </div>
            </div>
        </div>
    </section>

    <form wire:submit="update" class="w-full space-y-4">
        <!-- Type -->
        <div>
            <x-input-label for="product_type_id" :value="__('Tipe')" />
            <select wire:model="product_type_id" id="product_type_id" name="product_type_id"
                class="mt-1 block w-full rounded-md text-[rgb(var(--bg-rgb))]">
                <option value="" disabled>Pilih satu tipe</option>
                @foreach (ProductType::all() as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('product_type_id')" class="mt-2" />
        </div>

        <!-- Weight -->
        <div>
            <div class="flex items-center space-x-2">
                <x-input-label for="weight" :value="__('Berat Kategori')" />
                <div class="text-inactive text-upperwide text-[10px] font-bold">kg</div>
            </div>
            <x-text-input wire:model="weight" id="weight" name="weight" type="number" class="mt-1 block w-full"
                autocomplete="weight" />
            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
        </div>

        <!-- Price -->
        <div>
            <div class="flex items-center space-x-2">
                <x-input-label for="price" :value="__('Harga Kategori')" />
                <div class="text-inactive text-upperwide text-[10px] font-bold">IDR</div>
            </div>
            <x-text-input wire:model="price" id="price" name="price" type="number" class="mt-1 block w-full"
                autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Container -->
        <div>
            <x-input-label for="container" :value="__('Nama Kontainer')" />
            <x-text-input wire:model="container" id="container" name="container" type="text"
                class="mt-1 block w-full" autocomplete="container" />
            <x-input-error :messages="$errors->get('container')" class="mt-2" />
        </div>

        <x-primary-button>
            {{ __('Ubah') }}
        </x-primary-button>
    </form>
</section>
