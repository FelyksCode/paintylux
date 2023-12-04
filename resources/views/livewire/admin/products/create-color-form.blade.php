<?php

use App\Models\Color;

use function Livewire\Volt\{state, rules};

state([
    'name' => '',
    'hex' => '',
]);

rules([
    'name' => ['required', 'string', 'max:50'],
    'hex' => ['required', 'string', 'regex:' . config('const.REGEXP.hex_color')],
])->messages([
    'name.required' => 'Mohon mengisi nama warna.',
    'name.max' => 'Nama warna yang diisi terlalu panjang.',
    'hex.required' => 'Mohon memilih warna.',
    'hex.regex' => 'Mohon mengisi kode warna heksadesimal yang valid.',
]);

$create = function () {
    # Clean input
    $this->hex = trim($this->hex, '#');

    // Validate
    $validated = $this->validate();

    // Create new color
    Color::create($validated);

    // Clear states
    $this->name = '';
    $this->hex = '';

    // Dispatch event
    $this->dispatch('color-created');
};

?>

<div class="w-full space-y-4">
    <div class="text-upperwide text-xl">{{ __('Tambahkan Warna') }}</div>
    <form wire:submit="create" class="w-full max-w-full space-y-4 px-0">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Warna')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full"
                autocomplete="color" />
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
            {{ __('Tambah Warna') }}
        </x-primary-button>
    </form>
</div>
