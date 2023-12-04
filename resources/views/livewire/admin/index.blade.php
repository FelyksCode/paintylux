<?php

use App\Models\Order;
use App\Models\Message;
use App\Models\Color;
use App\Models\Project;
use App\Models\User;

use function Livewire\Volt\layout;

layout('layouts.admin');

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <div class="text-5xl font-light tracking-tighter">
            {{ __('Selamat datang di halaman Admin.') }}
        </div>
        <div class="text-inactive text-xl">
            {{ __('Di sini, Anda dapat mengatur dan mengelola berbagai hal untuk website Paintylux.') }}
        </div>
    </section>

    <!-- Summary -->
    <section class="space-y-4">

        <!-- Orders & Messages -->
        <div class="flex items-center space-x-6">
            <!-- Orders -->
            <x-admin.summary-box light class="flex h-[150px] flex-col justify-between space-y-4">
                <div>
                    <div class="text-upperwide text-lg font-bold">
                        {{ __('Order') }}
                    </div>
                    <div>
                        {{ __('Ada ' . count(Order::ongoing()) . ' order berlangsung dan ' . count(Order::finished()) . ' order yang sudah selesai.') }}
                    </div>
                </div>
                <a href="{{ route('admin-orders') }}"
                    class="text-upperwide smooth text-sm text-[rgba(var(--bg-rgb),0.7)] hover:opacity-80" wire:navigate>
                    {{ __('Lihat lebih lanjut') }}
                </a>
            </x-admin.summary-box>

            <!-- Messages -->
            <x-admin.summary-box light class="flex h-[150px] flex-col justify-between space-y-4">
                <div>
                    <div class="text-upperwide text-lg font-bold">
                        {{ __('Pesan') }}
                    </div>
                    <div>
                        {{ __('Ada ' . count(Message::notRead()) . ' pesan baru dan ' . count(Message::all()) . ' pesan secara total.') }}
                    </div>
                </div>
                <a href="{{ route('admin-messages') }}"
                    class="text-upperwide smooth text-sm text-[rgba(var(--bg-rgb),0.7)] hover:opacity-80" wire:navigate>
                    {{ __('Lihat lebih lanjut') }}
                </a>
            </x-admin.summary-box>
        </div>

        <!-- Models -->
        <div class="flex items-center space-x-6">
            <!-- Products -->
            <x-admin.summary-box class="flex h-[175px] flex-col justify-between space-y-4">
                <div>
                    <div class="text-upperwide text-lg font-bold">
                        {{ __('Produk') }}
                    </div>
                    <div>
                        {{ __('Ada ' . count(Color::all()) . ' warna yang sudah terdaftar.') }}
                    </div>
                </div>
                <a href="{{ route('admin-products') }}"
                    class="text-upperwide text-inactive smooth text-sm hover:opacity-80" wire:navigate>
                    {{ __('Lihat lebih lanjut') }}
                </a>
            </x-admin.summary-box>

            <!-- Projects -->
            <x-admin.summary-box class="flex h-[175px] flex-col justify-between space-y-4">
                <div>
                    <div class="text-upperwide text-lg font-bold">
                        {{ __('Proyek') }}
                    </div>
                    <div>
                        {{ __('Ada ' . count(Project::all()) . ' proyek terdaftar.') }}
                    </div>
                </div>
                <a href="{{ route('admin-projects') }}"
                    class="text-upperwide text-inactive smooth text-sm hover:opacity-80" wire:navigate>
                    {{ __('Lihat lebih lanjut') }}
                </a>
            </x-admin.summary-box>

            <!-- User -->
            <x-admin.summary-box class="flex h-[175px] flex-col justify-between space-y-4">
                <div>
                    <div class="text-upperwide text-lg font-bold">
                        {{ __('User') }}
                    </div>
                    <div>
                        {{ __('Ada ' . count(User::all()) . ' user secara total dengan jumlah ' . count(User::admins()) . ' admin.') }}
                    </div>
                </div>
                <a href="{{ route('admin-users') }}"
                    class="text-upperwide text-inactive smooth text-sm hover:opacity-80" wire:navigate>
                    {{ __('Lihat lebih lanjut') }}
                </a>
            </x-admin.summary-box>
        </div>
    </section>
</section>
