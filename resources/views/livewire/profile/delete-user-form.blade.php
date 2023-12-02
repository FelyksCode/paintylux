<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state(['password' => '']);

rules(['password' => ['required', 'string', 'current_password']])->messages([
    'password.required' => 'Mohon mengisi password Anda.',
    'password.current_password' => 'Password yang Anda isi salah.',
]);

$deleteUser = function (Logout $logout) {
    $this->validate();

    tap(Auth::user(), $logout(...))->delete();

    $this->redirect('/', navigate: true);
};

?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser"
            class="p-6 text-[rgb(var(--fg-rgb))] selection:bg-[rgb(var(--fg-rgb))] selection:text-[rgb(var(--bg-rgb))]">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
                {{-- {{ __('Are you sure you want to delete your account?') }} --}}
            </h2>

            <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Mohon mengisi password Anda untuk mengkonfirmasi penghapusan akun Anda.') }}
                {{-- {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }} --}}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input wire:model="password" id="password" name="password" type="password"
                    class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex">
                <x-primary-button class="!w-fit" x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-primary-button>

                <x-danger-button class="ms-3">
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
