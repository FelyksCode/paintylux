<?php

use App\Models\Color;

use function Livewire\Volt\{mount, layout, rules, state};

state(['color' => fn($id) => Color::findOrFail($id)])->locked();

state(['name', 'hex']);

mount(function () {
    $this->name = $this->color->name;
    $this->hex = '#' . $this->color->hex;
});

rules([
    'name' => ['required', 'string', 'max:50'],
    'hex' => ['required', 'string', 'regex:' . config('const.REGEXP.hex_color')],
])->messages([
    'name.required' => 'Mohon mengisi nama warna.',
    'name.max' => 'Nama warna yang diisi terlalu panjang.',
    'hex.required' => 'Mohon memilih warna.',
    'hex.regex' => 'Mohon mengisi kode warna heksadesimal yang valid.',
]);

layout('layouts.admin');

$update = function () {
    # Clean input
    $this->hex = trim($this->hex, '#');

    // Validate
    $validated = $this->validate();

    // Update color
    $this->color->update($validated);

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
                <div class="text-4xl font-light tracking-tighter min-[600px]:text-5xl">{{ __('Edit Warna ') }}<strong
                        class="font-bold">{{ $name }}</strong></div>
                <div class="text-inactive text-lg min-[600px]:text-xl">
                    {{ __('Ubah informasi mengenai warna ini.') }}
                </div>
            </div>
        </div>
    </section>

    <form wire:submit="update" class="w-full space-y-4">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Proyek')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full"
                autocomplete="project-name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Hex -->
        <div>
            <x-input-label for="hex" :value="__('Warna')" />
            <input wire:model="hex" id="hex" name="hex" type="color"
                class="border-1 mt-1 block h-[50px] w-full rounded-md border-none" />
            <x-input-error :messages="$errors->get('hex')" class="mt-2" />
        </div>

        <x-primary-button>
            {{ __('Ubah') }}
        </x-primary-button>
    </form>
</section>
