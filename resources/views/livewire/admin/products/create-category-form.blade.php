<?php

use App\Models\ProductType;
use App\Models\ProductCategory;

use function Livewire\Volt\{on, state, rules};

state([
    'price' => '',
    'weight' => '',
    'container' => '',
    'product_type_id' => '',
    'types' => ProductType::all(),
]);

on([
    'type-created' => function () {
        $this->types = ProductType::all();
    },
]);

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

$create = function () {
    // Validate
    $validated = $this->validate();

    // Create new category
    ProductCategory::create($validated);

    // Clear states
    $this->price = '';
    $this->weight = '';
    $this->container = '';
    $this->product_type_id = '';

    // Dispatch event
    $this->dispatch('category-created');
};

?>

<div class="w-full space-y-4">
    <div class="text-upperwide text-xl">{{ __('Tambahkan Kategori') }}</div>
    <form wire:submit="create" class="w-full max-w-full space-y-4 px-0">
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
            {{ __('Tambah Kategori') }}
        </x-primary-button>
    </form>
</div>
