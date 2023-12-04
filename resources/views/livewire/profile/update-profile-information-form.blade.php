<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;
use function Livewire\Volt\rules;

state([
    'name' => fn() => auth()->user()->name,
    'email' => fn() => auth()->user()->email,
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'regex:' . config('const.REGEXP.email'), 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)],
])->messages([
    'name.required' => 'Mohon mengisi nama Anda.',
    'name.max' => 'Nama yang diisi terlalu panjang.',
    'email.required' => 'Mohon mengisi email Anda.',
    'email.lowercase' => 'Email tidak boleh ada huruf kapital.',
    'email.regex' => 'Mohon mengisi email yang valid.',
    'email.max' => 'Email yang diisi terlalu panjang.',
    'email.unique' => 'Email sudah terpakai.',
]);

$updateProfileInformation = function () {
    $user = Auth::user();

    $validated = $this->validate();

    $user->fill($validated);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    $this->dispatch('profile-updated', name: $user->name);
};

$sendVerification = function () {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
        $path = session('url.intended', RouteServiceProvider::HOME);

        $this->redirect($path);

        return;
    }

    $user->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

?>

<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profil') }}
        </h2>

        <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
            {{ __('Perbarui nama dan email dari akun Anda.') }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="text" class="mt-1 block w-full"
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof MustVerifyEmail &&
                    !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-secondary-button type="submit">{{ __('Ganti') }}</x-secondary-button>
            <x-action-message class="me-3" on="profile-updated">
                {{ __('Profil berhasil diperbarui.') }}
            </x-action-message>
        </div>
    </form>
</section>
