<?php

use App\Models\ProductType;

use function Livewire\Volt\{mount, state, rules, usesFileUploads, layout};

usesFileUploads();

state(['type' => fn($id) => ProductType::findOrFail($id)])->locked();

state(['name', 'current_image', 'image']);

mount(function () {
    $this->name = $this->type->name;
    $this->current_image = $this->type->image;
    $this->image = '';
});

rules([
    'name' => ['required', 'string', 'max:50'],
    'image' => ['nullable', 'image', 'max:2048'],
])->messages([
    'name.required' => 'Mohon mengisi nama tipe.',
    'name.max' => 'Nama tipe yang diisi terlalu panjang.',
    'image.image' => 'File yang diunggah harus berupa gambar.',
    'image.max' => 'Gambar yang diunggah maksimal 2 MB.',
]);

layout('layouts.admin');

$update = function () {
    // Validate
    $validated = $this->validate();

    // Update type
    $this->type->update(['name' => $validated['name']]);

    // If new image is uploaded remove current image and store new one
    if ($validated['image']) {
        $this->type->deleteImage();
        $this->type->update([
            'image' => $this->image->storePublicly('images/products', 'public'),
        ]);
    }

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
                <div class="text-4xl font-light tracking-tighter min-[600px]:text-5xl">{{ __('Edit Tipe ') }}<strong
                        class="font-bold">{{ $name }}</strong></div>
                <div class="text-inactive text-lg min-[600px]:text-xl">
                    {{ __('Ubah informasi mengenai tipe ini.') }}
                </div>
            </div>
        </div>
    </section>

    <section
        class="flex flex-col space-y-10 min-[1000px]:h-[400px] min-[1000px]:flex-row min-[1000px]:items-center min-[1000px]:space-x-10 min-[1000px]:space-y-0">
        <img src="{{ asset(Storage::url($this->current_image)) }}" alt="{{ $this->name }}"
            class="h-[250px] rounded-xl object-scale-down min-[1000px]:h-full min-[1000px]:w-1/2">
        <form wire:submit="update" class="w-full max-w-full space-y-4" enctype="multipart/form-data">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Tipe')" />
                <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full"
                    autocomplete="type" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="image" :value="__('Ganti Gambar Tipe')" />
                <input wire:model="image" type="file" id="image" name="image"
                    class="mt-1 w-full rounded-md text-sm">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <x-primary-button>
                {{ __('Ubah') }}
            </x-primary-button>
        </form>
    </section>
</section>
