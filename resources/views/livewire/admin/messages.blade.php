<?php

use App\Models\Message;

use function Livewire\Volt\layout;

layout('layouts.admin');

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <x-header-count :title="__('Pesan')" :count="count(Message::all())" />
        <div class="text-inactive text-xl">
            {{ __('Lihat semua pesan dari pelanggan yang masuk.') }}
        </div>
    </section>

    <!-- New messages -->
    <section class="space-y-4">
        <x-header-count :title="__('Baru')" :count="count(Message::notRead())" small />
        @forelse (Message::notRead() as $message)
            <x-admin.summary-box
                class="flex flex-col space-y-8 min-[850px]:flex-row min-[850px]:items-center min-[850px]:justify-between min-[850px]:space-y-0">
                <div
                    class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-10 min-[850px]:space-y-0">
                    <div class="space-y-2">
                        <div>
                            <div class="text-xl font-bold">{{ $message->sender }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $message->contact }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $message->location }}</div>
                        </div>
                        <div class="text-upperwide text-sm font-bold">{{ get_date($message->created_at) }}</div>
                    </div>
                    <div class="hidden h-[100px] border-r border-r-[rgb(var(--fg-rgb))] min-[850px]:block"></div>
                    <hr class="block border-[rgb(var(--fg-rgb))] min-[850px]:hidden">
                    <div class="text-xl">
                        {{ $message->content }}
                    </div>
                </div>
                <div class="flex space-x-4 min-[850px]:flex-col min-[850px]:space-x-0 min-[850px]:space-y-3">
                    <x-icons.delete-button
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-message-{{ $message->id }}-deletion')" />
                    <x-icons.read-button wire:click="toggleRead({{ $message->id }})" />
                </div>
            </x-admin.summary-box>
            <x-modal name="confirm-message-{{ $message->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus pesan ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $message->id }})">
                            {{ __('Hapus Pesan') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada pesan baru.') }}</div>
        @endforelse
    </section>

    <!-- Old messages -->
    <section class="space-y-4">
        <x-header-count :title="__('Sudah terbaca')" :count="count(Message::read())" small />
        @forelse (Message::read() as $message)
            <x-admin.summary-box
                class="flex flex-col space-y-8 min-[850px]:flex-row min-[850px]:items-center min-[850px]:justify-between min-[850px]:space-y-0"
                light>
                <div
                    class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-10 min-[850px]:space-y-0">
                    <div class="space-y-2">
                        <div>
                            <div class="text-xl font-bold">{{ $message->sender }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $message->contact }}</div>
                            <div class="text-upperwide text-sm opacity-80">{{ $message->location }}</div>
                        </div>
                        <div class="text-upperwide text-sm font-bold">{{ get_date($message->created_at) }}</div>
                    </div>
                    <div class="hidden h-[100px] border-r border-r-[rgb(var(--bg-rgb))] min-[850px]:block"></div>
                    <hr class="block border-[rgb(var(--bg-rgb))] min-[850px]:hidden">
                    <div class="text-xl">
                        {{ $message->content }}
                    </div>
                </div>
                <div class="flex space-x-4 min-[850px]:flex-col min-[850px]:space-x-0 min-[850px]:space-y-3">
                    <x-icons.delete-button
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-message-{{ $message->id }}-deletion')" />
                    <x-icons.read-button wire:click="toggleRead({{ $message->id }})" read />
                </div>
            </x-admin.summary-box>
            <x-modal name="confirm-message-{{ $message->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus pesan ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $message->id }})">
                            {{ __('Hapus Pesan') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada pesan yang sudah terbaca.') }}</div>
        @endforelse
    </section>
</section>
