<?php

use App\Models\Message;

use App\Livewire\Forms\ContactForm;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.app');

form(ContactForm::class);

$send = function () {
    $validated = $this->form->validate();
    Message::create($validated);
    $this->dispatch('message-sent');
};

?>

<section class="std-section">
    <div class="mb-8 text-5xl font-light tracking-tighter">Hubungi kami</div>
    <form wire:submit="send" class="relative space-y-2">
        <!-- Sender -->
        <div>
            <x-input-label for="sender" :value="__('Nama')" />
            <x-text-input wire:model="form.sender" id="sender" class="mt-1 block w-full" type="text" name="sender"
                autofocus autocomplete="username" wire:model.live.debounce.0ms="form.sender" />
            @error('form.sender')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Email address/Phone number -->
        <div>
            <x-input-label for="contact" :value="__('Email/Nomor Telepon')" />
            <x-text-input wire:model="form.contact" id="contact" class="mt-1 block w-full" type="text"
                name="contact" autocomplete="email" wire:model.live.debounce.0ms="form.contact" />
            @error('form.contact')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Location -->
        <div>
            <x-input-label for="location" :value="__('Lokasi')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text"
                name="location" autocomplete="username" wire:model.live.debounce.0ms="form.location" />
            @error('form.location')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Message -->
        <div>
            <x-input-label for="content" :value="__('Pesan')" />
            <x-textarea wire:model="form.content" name="content" id="content"
                wire:model.live.debounce.0ms="form.content" />
            @error('form.content')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <x-primary-button>
            {{ __('Kirim Pesan') }}
        </x-primary-button>

        <x-action-message class="absolute flex w-full justify-center" on="message-sent">
            {{ __('Pesan Anda telah dikirim.') }}
        </x-action-message>
    </form>
</section>
