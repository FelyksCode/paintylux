<x-app-layout>
    <section class="std-section space-y-16">
        <div class="absolute left-0 top-0 z-[-1] opacity-70">
            <div
                class="pulse flex aspect-square h-[500px] w-[500px] items-center justify-center rounded-full border border-[rgb(var(--acc-rgb))]">
                <div
                    class="pulse flex aspect-square h-[300px] w-[300px] items-center justify-center rounded-full border border-[rgb(var(--acc-rgb))] delay-[50ms]">
                    <div
                        class="pulse aspect-square h-[150px] w-[150px] rounded-full border border-[rgb(var(--acc-rgb))] delay-100">
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex h-[350px] w-full items-center justify-center space-x-14">
            <!-- Hero -->
            <img src="{{ asset('assets/products/exterior-interior.png') }}" alt="Paint Bucket"
                class="float z-[1] w-[200px] min-[1000px]:w-[250px] min-[1300px]:w-[300px]">

            <!-- Welcome -->
            <div class="relative flex flex-col space-y-8">
                <div>
                    <div class="text-3xl font-light tracking-tighter min-[1300px]:text-4xl">
                        {{ __('Welcome to') }}
                    </div>
                    <x-application-logo class="w-[300px] min-[1000px]:w-[400px] min-[1300px]:w-[600px]" />
                </div>
                <a href="{{ route('products') }}"
                    class="smooth group flex w-fit items-center space-x-2 rounded-xl border border-[rgb(var(--acc-rgb))] px-8 py-2 text-[rgb(var(--acc-rgb))] hover:opacity-80">
                    <div
                        class="text-upperwide smooth text-lg opacity-90 group-hover:tracking-[0.15em] group-hover:opacity-100">
                        {{ __('Lihat produk kami') }}
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="smooth h-5 w-5 opacity-90 group-hover:-rotate-90 group-hover:opacity-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
        <hr class="border border-[rgba(var(--fg-rgb),0.2)]">

        <!-- Products -->
        <div>
            <div class="flex flex-col items-center space-y-6 text-center text-3xl font-light tracking-tighter">
                <div class="max-w-[600px]">
                    {{ __('Cat tembok berkualitas tinggi dengan pilihan warna-warna yang indah') }}
                </div>
                <div class="flex items-center space-x-12">
                    <div class="h-[60px] w-[60px] rounded-full bg-[rgb(var(--green-rgb))]"></div>
                    <div class="h-[60px] w-[60px] rounded-full bg-[rgb(var(--blue-rgb))]"></div>
                    <div class="h-[60px] w-[60px] rounded-full bg-[rgb(var(--black-rgb))]"></div>
                    <div class="h-[60px] w-[60px] rounded-full bg-[rgb(var(--red-rgb))]"></div>
                    <div class="h-[60px] w-[60px] rounded-full bg-[rgb(var(--gray-rgb))]"></div>
                    <div class="h-[60px] w-[60px] rounded-full bg-[rgb(var(--orange-rgb))]"></div>
                </div>
            </div>
            <div class="">

            </div>
        </div>
        <hr class="border border-[rgba(var(--fg-rgb),0.2)]">

        <!-- Projects -->
        <div>
            <div class="flex flex-col items-center space-y-6 text-center text-3xl font-light tracking-tighter">
                <div class="max-w-[600px]">
                    {{ __('Paintylux telah digunakan dalam banyak proyek') }}
                </div>
                <div class="flex items-center space-x-12">
                    <div
                        class="flex h-[250px] w-[250px] items-center justify-center rounded-xl border border-[rgb(var(--black-rgb))] text-sm">
                        Image here
                    </div>
                    <div
                        class="flex h-[250px] w-[250px] items-center justify-center rounded-xl border border-[rgb(var(--black-rgb))] text-sm">
                        Image here
                    </div>
                    <div
                        class="flex h-[250px] w-[250px] items-center justify-center rounded-xl border border-[rgb(var(--black-rgb))] text-sm">
                        Image here
                    </div>
                </div>
            </div>
            <div class="">

            </div>
        </div>
    </section>
</x-app-layout>
