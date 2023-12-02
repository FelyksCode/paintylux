<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Livewire\Forms\RegisterForm;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Validate;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;
use function Livewire\Volt\form;

layout('layouts.app');

form(RegisterForm::class);

$register = function () {
    $validated = $this->form->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered(($user = User::create($validated))));

    Auth::login($user);

    $this->redirect(RouteServiceProvider::HOME, navigate: true);
};

?>

<section class="auth-section">
    <!-- Header -->
    <div class="text-center text-2xl font-bold min-[360px]:text-3xl sm:text-4xl">
        {{ __('Gabung dengan kami') }}
    </div>

    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" name="name"
                autofocus autocomplete="name" wire:model.live.debounce.0ms="form.name" />
            @error('form.name')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="text" name="email"
                autocomplete="username" wire:model.live.debounce.50ms="form.email" />
            @error('form.email')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="mt-1 block w-full" type="password"
                name="password" autocomplete="new-password" wire:model.live.debounce.0ms="form.password" />

            @error('form.password')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input wire:model="form.password_confirmation" id="password_confirmation" class="mt-1 block w-full"
                type="password" name="password_confirmation" autocomplete="new-password"
                wire:model.live.debounce.0ms="form.password_confirmation" />

            @error('form.password_confirmation')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <x-primary-button class="mt-4">
            {{ __('Register') }}
        </x-primary-button>

        <div class="mt-4 text-center">
            <a class="text-link text-sm" href="{{ route('login') }}" wire:navigate>
                {{ __('Sudah memiliki akun?') }}
            </a>
        </div>
    </form>
</section>
