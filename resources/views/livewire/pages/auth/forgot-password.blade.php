<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.app');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']])
    ->messages([
        "email.required" => "Mohon mengisi email Anda.",
        "email.email" => "Mohon mengisi email yang valid.",
    ]);

$sendPasswordResetLink = function () {
    $this->validate();

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $status = Password::sendResetLink(
        $this->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));

        return;
    }

    $this->reset('email');

    Session::flash('status', __($status));
};

?>

<section class="auth-section">
    <!-- Header -->
    <div class="text-2xl min-[360px]:text-3xl sm:text-4xl font-bold text-center">
        {{ __('Lupa password?') }}
    </div>

    <div class="mb-4 text-sm text-gray-600 w-full sm:max-w-md text-center">
        {{ __('Tidak masalah. Cukup beri tahu kami email Anda dan kami akan mengirimkan email berisi link pengaturan ulang password.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="text" name="email" autofocus wire:model.live="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</section>
