<x-app-layout>
    <section class="std-section">
        <section class="relative flex h-[400px] w-full items-center justify-center">
            <!-- Hero -->
            <img src="{{ asset('assets/hero.png') }}" alt="Paint Bucket"
                class="float w-[250px] min-[1000px]:w-[300px] min-[1300px]:w-[400px]">

            <!-- Welcome -->
            <div class="relative flex flex-col space-y-8">
                <div>
                    <div class="text-3xl font-light tracking-tighter min-[1300px]:text-4xl">
                        {{ __('Welcome to') }}
                    </div>
                    <x-application-logo class="-ml-[40px] w-[400px] min-[1000px]:w-[500px] min-[1300px]:w-[700px]" />
                </div>
                <a href="{{ route('products') }}"
                    class="smooth group flex w-fit items-center space-x-2 rounded-xl border border-[rgb(var(--acc-rgb))] px-8 py-2 text-[rgb(var(--acc-rgb))] hover:opacity-80">
                    <div
                        class="text-upperwide smooth text-xl opacity-90 group-hover:tracking-[0.15em] group-hover:opacity-100">
                        {{ __('Lihat produk kami') }}
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="smooth h-6 w-6 opacity-90 group-hover:-rotate-90 group-hover:opacity-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>
    </section>
</x-app-layout>
