<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.app');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);
};

?>

<section class="auth-section">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header -->
    <div class="text-center text-2xl font-bold min-[360px]:text-3xl sm:text-4xl">
        {{ __('Selamat datang kembali!') }}
    </div>

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="text" name="email"
                autofocus autocomplete="username" wire:model.live.debounce.0ms="form.email" />
            @error('form.email')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="mt-1 block w-full" type="password"
                name="password" autocomplete="current-password" wire:model.live.debounce.0ms="form.password" />

            @error('form.password')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>

        <div
            class="mb-4 mt-4 flex flex-col items-center space-y-3 min-[360px]:flex-row min-[360px]:justify-between min-[360px]:space-y-0">
            <!-- Forgot password -->
            @if (Route::has('password.request'))
                <a class="smooth rounded-md text-sm underline hover:text-[rgb(var(--gray-rgb))] focus:outline-none focus:ring-2 focus:ring-offset-2"
                    href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Lupa password?') }}
                </a>
            @endif
            <!-- Remember Me -->
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="smooth rounded bg-transparent text-[rgb(var(--blue-rgb))] shadow-sm focus:ring-[rgb(var(--blue-rgb))]"
                    name="remember">
                <span class="ms-2 text-sm text-[rgb(var(--gray-rgb))]">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <x-primary-button>
            {{ __('Masuk') }}
        </x-primary-button>
        @error('form')
            <x-input-error :messages="$message" class="mt-2 text-center" />
        @enderror

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-link text-sm">Belum memiliki akun?</a>
        </div>
    </form>
</section>
