<x-app-layout>
    <section class="std-section py-4">
        <!-- Title -->
        <div class="mb-[50px] space-y-2 text-center">
            <div class="text-center text-4xl tracking-tighter">
                {{ __('Pilih jenis cat') }}
            </div>
            <div class="text-inactive text-upperwide text-sm">
                {{ __('Semua jenis tersedia dalam semua warna') }}
            </div>
        </div>

        <!-- Grid -->
        <div class="grid w-full grid-cols-3 gap-8">
            <!-- Type -->
            <a href="{{ route('products') }}" class="smooth flex flex-col items-center space-y-8 hover:scale-105">
                <div
                    class="flex h-[300px] w-full items-center justify-center rounded-xl border border-[rgb(var(--fg-rgb))] px-8 py-4">
                    <img src="{{ asset('assets/products/exterior-interior.png') }}" alt="Exterior & Interior"
                        class="float w-[500px]">
                </div>
                <div class="text-upperwide text-xl">
                    {{ __('Exterior & Interior') }}
                </div>
            </a>

            <!-- Type -->
            <a href="{{ route('products') }}" class="smooth flex flex-col items-center space-y-8 hover:scale-105">
                <div
                    class="flex h-[300px] w-full items-center justify-center rounded-xl border border-[rgb(var(--fg-rgb))] px-8 py-4">
                    <img src="{{ asset('assets/products/weather-shield.png') }}" alt="Exterior & Interior"
                        class="float w-[500px] [animation-duration:7s]">
                </div>
                <div class="text-upperwide text-xl">
                    {{ __('Weather Shield') }}
                </div>
            </a>

            <!-- Type -->
            <a href="{{ route('products') }}" class="smooth flex flex-col items-center space-y-8 hover:scale-105">
                <div
                    class="flex h-[300px] w-full items-center justify-center rounded-xl border border-[rgb(var(--fg-rgb))] px-8 py-4">
                    <img src="{{ asset('assets/products/alkali-sealer.png') }}" alt="Exterior & Interior"
                        class="float w-[500px] [animation-duration:8s]">
                </div>
                <div class="text-upperwide text-xl">
                    {{ __('Alkali Sealer') }}
                </div>
            </a>
        </div>
    </section>
</x-app-layout>
