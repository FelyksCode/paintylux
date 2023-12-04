<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav id="navbar" x-data="{ open: false, overThreshold: (window.pageYOffset > 10) }" @scroll.window="overThreshold = window.pageYOffset > 10"
    @resize.window="open = window.innerWidth >= 1000 ? false : open"
    class="h-[var(--navbar-height) smooth fixed left-0 top-0 z-[2] w-screen"
    :class="(open || overThreshold) ?
    'bg-[rgba(var(--bg-rgb),0.6)] backdrop-blur-lg border-b border-b-[rgba(var(--fg-rgb),0.6)]' :
    'border-b-[rgba(var(--fg-rgb),0)]'">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 w-full justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="float-in-down flex shrink-0 items-center opacity-0">
                    <a href="{{ route('admin') }}" wire:navigate class="flex items-center space-x-3">
                        <x-application-logo id="navlogo" class="block fill-current" :light="true" />
                        <div class="text-upperwide hidden font-light min-[380px]:block">Admin</div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 min-[1000px]:-my-px min-[1000px]:ms-10 min-[1000px]:flex">
                    <x-nav-link :href="route('admin-orders')" :active="request()->routeIs('admin-orders')" wire:navigate
                        class="float-in-down opacity-0 [animation-delay:0.2s]">
                        {{ __('Order') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-messages')" :active="request()->routeIs('admin-messages')" wire:navigate
                        class="float-in-down opacity-0 [animation-delay:0.4s]">
                        {{ __('Pesan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-products')" :active="request()->routeIs('admin-products')" wire:navigate
                        class="float-in-down opacity-0 [animation-delay:0.6s]">
                        {{ __('Produk') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-projects')" :active="request()->routeIs('admin-projects')" wire:navigate
                        class="float-in-down opacity-0 [animation-delay:0.8s]">
                        {{ __('Proyek') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin-users')" :active="request()->routeIs('admin-users')" wire:navigate
                        class="float-in-down opacity-0 [animation-delay:1s]">
                        {{ __('User') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div
                    class="float-in-down hidden opacity-0 [animation-delay:1.2s] min-[1000px]:ms-6 min-[1000px]:flex min-[1000px]:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center rounded-md border border-transparent bg-[rgb(var(--fg-rgb))] px-3 py-2 text-sm font-medium leading-4 text-[rgb(var(--bg-rgb))] transition duration-150 ease-in-out hover:text-[rgba(var(--bg-rgb),0.85)] focus:outline-none">
                                <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="ms-1">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('index')" wire:navigate>
                                {{ __('Beranda') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="float-in-down flex items-center opacity-0 [animation-delay:0.2s] min-[1000px]:hidden">
                <button @click="open = ! open" :data-state="open ? 'opened' : 'closed'" id="hamburger"
                    class="hamburger-btn smooth -mt-1 inline-flex items-center justify-center rounded-md p-2 text-[rgba(var(--fg-rgb),0.7)] hover:text-[rgb(var(--fg-rgb))] focus:text-[rgba(var(--fg-rgb),0.7)] focus:outline-none">
                    <svg stroke="rgb(var(--fg-rgb))" class="hamburger" viewBox="0 0 100 100" width="30">
                        <line class="line top" x1="90" x2="10" y1="40" y2="40"
                            stroke-width="5" stroke-linecap="round" stroke-dasharray="80" stroke-dashoffset="0">
                        </line>
                        <line class="line bottom" x1="10" x2="90" y1="60" y2="60"
                            stroke-width="5" stroke-linecap="round" stroke-dasharray="80" stroke-dashoffset="0">
                        </line>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden min-[1000px]:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('admin-orders')" :active="request()->routeIs('admin-orders')" wire:navigate class="float-in-down opacity-0">
                {{ __('Order') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-messages')" :active="request()->routeIs('admin-messages')" wire:navigate
                class="float-in-down opacity-0 [animation-delay:0.1s]">
                {{ __('Pesan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-products')" :active="request()->routeIs('admin-products')" wire:navigate
                class="float-in-down opacity-0 [animation-delay:0.2s]">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-projects')" :active="request()->routeIs('admin-projects.*')" wire:navigate
                class="float-in-down opacity-0 [animation-delay:0.3s]">
                {{ __('Proyek') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin-users')" :active="request()->routeIs('admin-users')" wire:navigate
                class="float-in-down opacity-0 [animation-delay:0.4s]">
                {{ __('User') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="navlink smooth float-in-down border-t border-gray-200 pb-1 pt-4 opacity-0 [animation-delay:0.45s]">
                <div class="float-in-down px-4 opacity-0 [animation-delay:0.5s]">
                    <div class="text-base font-medium" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="text-sm font-medium opacity-60">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('index')" wire:navigate
                        class="float-in-down opacity-0 [animation-delay:0.6s]">
                        {{ __('Beranda') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="float-in-down w-full text-start opacity-0 [animation-delay:0.7s]">
                        <x-responsive-nav-link>
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth
    </div>
</nav>
