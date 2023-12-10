<?php

use App\Models\User;

use function Livewire\Volt\layout;

layout('layouts.admin');

$delete = function ($id) {
    User::find($id)->delete();
};

$toggleVerify = function ($id) {
    $user = User::find($id);
    $user->is_admin = !$user->is_admin;
    $user->save();
};

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <x-header-count :title="__('User')" :count="User::all()->count()" />
        <div class="text-inactive text-xl">
            {{ __('Kelola pengguna Paintylux.') }}
        </div>
    </section>

    <!-- Admins -->
    <section class="space-y-4">
        <x-header-count :title="__('Admin')" :count="User::admins()->count()" small />
        @forelse (User::admins() as $user)
            <x-admin.summary-box
                class="flex flex-col space-y-8 px-6 min-[400px]:px-10 min-[850px]:flex-row min-[850px]:items-center min-[850px]:justify-between min-[850px]:space-y-0">
                <div
                    class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-10 min-[850px]:space-y-0">
                    <div class="space-y-4">
                        <div>
                            <div class="text-xl font-bold">
                                {{ $user->name }}
                                @if (Auth::user()->id === $user->id)
                                    <span class="font-light"> (Anda)</span>
                                @endif
                            </div>
                            <div class="text-upperwide text-sm opacity-80">{{ $user->email }}</div>
                        </div>
                        <div>
                            <div class="text-upperwide text-sm font-light">Mendaftar
                                pada <span class="font-bold">{{ get_date($user->created_at) }}
                            </div>
                            <div class="text-upperwide text-sm font-light">
                                Email
                                <span class="font-bold">
                                    @if ($user->email_verified_at)
                                        sudah
                                    @else
                                        belum
                                    @endif
                                    terverifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @unless (Auth::user()->id === $user->id)
                    <div class="flex space-x-4 min-[850px]:flex-col min-[850px]:space-x-0 min-[850px]:space-y-3">
                        <x-icons.delete-button
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-{{ $user->id }}-deletion')" />
                        <x-icons.verify-button wire:click="toggleVerify({{ $user->id }})" verified />
                    </div>
                @endunless
            </x-admin.summary-box>
            <x-modal name="confirm-user-{{ $user->id }}-deletion" :show="false" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus pengguna ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $user->id }})"
                            x-on:click="$dispatch('close')">
                            {{ __('Hapus Pengguna') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada admin.') }}</div>
        @endforelse
    </section>

    <!-- Non-admins -->
    <section class="space-y-4">
        <x-header-count :title="__('Pengguna Biasa')" :count="User::nonAdmins()->count()" small />
        @forelse (User::nonAdmins() as $user)
            <x-admin.summary-box
                class="flex flex-col space-y-8 min-[850px]:flex-row min-[850px]:items-center min-[850px]:justify-between min-[850px]:space-y-0"
                light>
                <div
                    class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-10 min-[850px]:space-y-0">
                    <div class="space-y-4">
                        <div>
                            <div class="text-xl font-bold">{{ $user->name }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $user->email }}</div>
                        </div>
                        <div>
                            <div class="text-upperwide text-sm font-light">Mendaftar
                                pada <span class="font-bold">{{ get_date($user->created_at) }}
                            </div>
                            <div class="text-upperwide text-sm font-light">
                                Email
                                <span class="font-bold">
                                    @if ($user->email_verified_at)
                                        sudah
                                    @else
                                        belum
                                    @endif
                                    terverifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden h-[100px] border-r border-r-[rgb(var(--bg-rgb))] min-[850px]:block"></div>
                    <hr class="block border-[rgb(var(--bg-rgb))] min-[850px]:hidden">
                    <div class="text-xl">
                        <div>Memiliki {{ $user->ongoingOrders()->count() }} pesanan yang sedang diproses. </div>
                        <div>Memiliki {{ $user->finishedOrders()->count() }} pesanan yang sudah selesai.</div>
                    </div>
                </div>
                <div class="flex space-x-4 min-[850px]:flex-col min-[850px]:space-x-0 min-[850px]:space-y-3">
                    <x-icons.delete-button
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-{{ $user->id }}-deletion')" />
                    <x-icons.verify-button wire:click="toggleVerify({{ $user->id }})" />
                </div>
            </x-admin.summary-box>
            <x-modal name="confirm-user-{{ $user->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus pengguna ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $user->id }})">
                            {{ __('Hapus Pengguna') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada pengguna biasa.') }}</div>
        @endforelse
    </section>
</section>
