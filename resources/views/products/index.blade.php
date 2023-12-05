@php
    use App\Models\ProductType;
@endphp

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
            @foreach (ProductType::allOrdered() as $type)
                <a href="{{ route('products') }}" class="smooth flex flex-col items-center space-y-8 hover:scale-105">
                    <div
                        class="flex h-[300px] w-full items-center justify-center rounded-xl border border-[rgb(var(--fg-rgb))] px-8 py-4">
                        <img src="{{ asset(Storage::url($type->image)) }}" alt="{{ __($type->name) }}"
                            class="float w-[500px]" style="animation-duration: {{ 6 + $loop->index }}s">
                    </div>
                    <div class="text-upperwide text-xl">
                        {{ __($type->name) }}
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</x-app-layout>
