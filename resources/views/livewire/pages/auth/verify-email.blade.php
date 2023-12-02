<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;

layout('layouts.app');

$sendVerification = function () {
    if (Auth::user()->hasVerifiedEmail()) {
        $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);

        return;
    }

    Auth::user()->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<section class="auth-section min-h-[calc(100vh-519px)]">
    <div class="text-center text-2xl font-bold min-[360px]:text-3xl sm:max-w-md sm:text-4xl">
        {{ __('Terima kasih telah mendaftar, ') . strtok(auth()->user()->name, ' ') . '!' }}
        {{-- {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }} --}}
    </div>

    <div class="mb-4 w-full text-center text-sm text-gray-600 sm:max-w-md">
        {{ __('Sebelum memulai, Anda perlu memverifikasi email Anda dengan membuka link yang baru saja kami kirimkan melalui email Anda.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ __('Link verifikasi baru telah dikirim ke email yang Anda gunakan saat pendaftaran.') }}
            {{-- {{ __('A new verification link has been sent to the email address you provided during registration.') }} --}}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <x-primary-button wire:click="sendVerification">
            {{ __('Kirim Ulang Email Verifikasi') }}
            {{-- {{ __('Resend Verification Email') }} --}}
        </x-primary-button>
    </div>
</section>
