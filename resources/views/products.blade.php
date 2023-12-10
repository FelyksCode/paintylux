@php
    use App\Models\ProductType;
@endphp

<x-app-layout>
    <x-slot:title>{{ __('Pilih Produk') }}</x-slot>
    <section class="std-section py-4">
        <!-- Title -->
        <div class="mb-[50px] space-y-2 text-center opacity-0" x-intersect="$el.classList.add('float-in-up')">
            <div class="text-center text-4xl tracking-tighter">
                {{ __('Pilih jenis cat') }}
            </div>
            <div class="text-inactive text-upperwide text-sm">
                {{ __('Semua jenis tersedia dalam semua warna') }}
            </div>
        </div>

        <!-- Grid -->
        <div class="grid w-full grid-cols-1 gap-8 xl:grid-cols-3">
            @foreach (ProductType::allOrdered() as $type)
                <div class="opacity-0" x-intersect="$el.classList.add('float-in-up')">
                    <a href="{{ route('products.type', ['slug' => $type->slug()]) }}"
                        class="smooth flex flex-col items-center space-y-4 hover:scale-105 xl:space-y-8" wire:navigate>
                        <div
                            class="flex h-full w-fit items-center justify-center rounded-xl border border-[rgb(var(--fg-rgb))] px-8 py-4 min-[400px]:h-[300px]">
                            <img src="{{ asset(Storage::url($type->image)) }}" alt="{{ __($type->name) }}"
                                class="float h-full w-full xl:h-auto xl:w-[500px]"
                                style="animation-duration: {{ 6 + $loop->index }}s" loading="lazy">
                        </div>
                        <div class="text-upperwide text-center text-xl">
                            {{ __($type->name) }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
