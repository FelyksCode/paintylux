<x-app-layout>
    <x-slot:title>{{ __('Edit Profil') }}</x-slot>
    <section class="std-section space-y-6">
        <div class="flex items-center space-x-4">
            <x-icons.back-button :link="route('profile')" class="h-11 w-11" />
            <h2 class="text-5xl font-light tracking-tighter text-gray-800">
                {{ __('Edit Profil') }}
            </h2>
        </div>
        <div
            class="rounded-lg bg-[rgb(var(--fg-rgb))] p-4 text-[rgb(var(--bg-rgb))] selection:bg-[rgb(var(--bg-rgb))] selection:text-[rgb(var(--fg-rgb))] sm:p-8">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <div
            class="rounded-lg bg-[rgb(var(--fg-rgb))] p-4 text-[rgb(var(--bg-rgb))] selection:bg-[rgb(var(--bg-rgb))] selection:text-[rgb(var(--fg-rgb))] sm:p-8">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <div
            class="rounded-lg bg-[rgb(var(--fg-rgb))] p-4 text-[rgb(var(--bg-rgb))] selection:bg-[rgb(var(--bg-rgb))] selection:text-[rgb(var(--fg-rgb))] sm:p-8">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </section>
</x-app-layout>
