<footer
    class="mt-10 w-screen bg-[rgb(var(--acc-rgb))] py-10 text-[rgb(var(--white-rgb))] selection:bg-[rgb(var(--white-rgb))] selection:text-[rgb(var(--acc-rgb))]"
    x-cloak x-data="{ show: false, showPage() { setTimeout(() => this.show = true, 100) } }" x-transition.opacity.1500ms x-show="show" x-init="showPage">
    <div class="std-section space-y-6">
        <!-- Title -->
        <a href="{{ route('contact') }}" class="group flex w-fit items-center space-x-4">
            <div class="smooth text-4xl font-semibold group-hover:tracking-wider">{{ __('Hubungi kami') }}</div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor" class="smooth h-8 w-8 group-hover:-rotate-90">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
            </svg>
        </a>
        <hr class="border border-[rgb(var(--white-rgb))]">

        <!-- Information -->
        <div class="flex justify-between">
            <!-- Contact -->
            <div class="flex w-1/2 justify-between">
                <!-- Address -->
                <div class="flex flex-col space-y-2">
                    <div class="text-upperwide font-bold">
                        {{ __('Alamat') }}
                    </div>
                    <div class="tracking-wide">
                        @foreach (config('const.CONTACT.ADDRESS') as $line)
                            <p>{{ $line }}</p>
                        @endforeach
                    </div>
                </div>

                <!-- Numbers -->
                <div class="flex flex-col space-y-2">
                    <div class="text-upperwide font-bold">
                        {{ __('Kontak') }}
                    </div>
                    <div class="tracking-wide">
                        @foreach (config('const.CONTACT.PHONE') as $number)
                            <div class="-mb-1 flex items-center">
                                <x-whats-app-logo class="-ml-1 h-7 w-7" />
                                <div>{{ $number }}</div>
                            </div>
                        @endforeach
                        @foreach (config('const.CONTACT.EMAIL') as $email)
                            <div class="mt-[2px] flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <div>{{ $email }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Links -->
            <div class="flex flex-col items-end space-y-2">
                <a href="{{ route('index') }}" class="text-upperwide smooth font-bold hover:opacity-80">
                    {{ __('Beranda') }}
                </a>
                <a href="{{ route('products') }}" class="text-upperwide smooth font-bold hover:opacity-80">
                    {{ __('Produk') }}
                </a>
                <a href="{{ route('projects') }}" class="text-upperwide smooth font-bold hover:opacity-80">
                    {{ __('Proyek') }}
                </a>
                <a href="{{ route('contact') }}" class="text-upperwide smooth font-bold hover:opacity-80">
                    {{ __('Hubungi kami') }}
                </a>
            </div>
        </div>
        <hr class="border border-[rgb(var(--white-rgb))]">

        <!-- Copyright -->
        <div class="flex items-center justify-center space-x-4 text-sm">
            <span>Copyright © 2023 Paintylux.</span>
            <x-application-logo light="true" class="!w-[120px]" />
        </div>
    </div>
</footer>
