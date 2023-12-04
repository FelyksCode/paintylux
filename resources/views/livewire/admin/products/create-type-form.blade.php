<?php

use App\Models\ProductType;

use function Livewire\Volt\{state, rules, usesFileUploads};

usesFileUploads();

state([
    'name' => '',
    'image' => '',
]);

rules([
    'name' => ['required', 'string', 'max:50'],
    'image' => ['required', 'image', 'max:2048'],
])->messages([
    'name.required' => 'Mohon mengisi nama tipe.',
    'name.max' => 'Nama tipe yang diisi terlalu panjang.',
    'image.required' => 'Mohon mengunggah gambar tipe.',
    'image.image' => 'File yang diunggah harus berupa gambar.',
    'image.max' => 'Gambar yang diunggah maksimal 2 MB.',
]);

$create = function () {
    // Validate
    $validated = $this->validate();

    // Get path and create new product type
    $path = $this->image->storePublicly('images/producttypes', 'public');
    ProductType::create(['name' => $validated['name'], 'image' => $path]);

    // Clear states
    $this->name = '';
    $this->image = '';

    // Dispatch event
    $this->dispatch('type-created');
};

?>

<div class="w-full space-y-4">
    <div class="text-upperwide text-xl">{{ __('Tambahkan Tipe') }}</div>
    <form wire:submit="create" class="w-full max-w-full space-y-4 px-0" enctype="multipart/form-data">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Tipe')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full"
                autocomplete="type" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Image -->
        <div>
            <x-input-label for="image" :value="__('Gambar Tipe')" />
            <input wire:model="image" type="file" id="image" name="image"
                class="mt-1 w-full rounded-md text-sm">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <x-primary-button>
            {{ __('Tambah Tipe') }}
        </x-primary-button>
    </form>
</div>
