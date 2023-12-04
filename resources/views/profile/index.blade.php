<x-app-layout>
    <section class="std-section space-y-8">
        {{-- Header --}}
        <section class="flex flex-col space-y-6">
            {{-- User details --}}
            <div>
                <div class="text-7xl font-light tracking-tighter">
                    {{ __('Halo, ') . auth()->user()->name }}!
                </div>
                <div class="text-inactive text-2xl">
                    {{ auth()->user()->email }}
                </div>
            </div>

            {{-- Edit profile link --}}
            <div class="flex flex-col space-y-2">
                <a href="{{ route('edit-profile') }}" wire:navigate
                    class="smooth group flex w-fit items-center space-x-2 border-b border-b-[rgb(var(--fg-rgb))] opacity-60 hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="smooth h-5 w-5 group-hover:rotate-[-30deg]">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>

                    <div class="text-upperwide text-lg">
                        {{ __('Edit Profil') }}
                    </div>
                </a>
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin') }}"
                        class="smooth group flex w-fit items-center space-x-2 border-b border-b-[rgb(var(--fg-rgb))] opacity-60 hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="smooth h-5 w-5 group-hover:rotate-[-30deg]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                        <div class="text-upperwide text-lg">
                            {{ __('Dashboard Admin') }}
                        </div>
                    </a>
                @endif
            </div>
        </section>

        {{-- Border --}}
        <hr class="border-[rgb(var(--black-rgb))]">

        {{-- Orders --}}
        <section>
            {{-- Header --}}
            <div class="text-upperwide mb-4 text-3xl">
                {{ __('Riwayat pemesanan') }}
            </div>

            {{-- List --}}
            <div class="text-inactive text-xl">
                {{ __('Anda belum pernah melakukan pemesanan.') }}
            </div>
        </section>
    </section>
</x-app-layout>
