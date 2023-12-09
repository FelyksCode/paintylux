<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Message;

use App\Livewire\Forms\ContactForm;

use function Livewire\Volt\{form, layout, mount};

use Masmerise\Toaster\Toaster;

layout('layouts.app');

form(ContactForm::class);

mount(function () {
    $this->form->sender = Auth::check() ? Auth::user()->name : '';
    $this->form->contact = Auth::check() ? Auth::user()->email : '';
});

$send = function () {
    $validated = $this->form->validate();
    Message::create($validated);
    $this->dispatch('message-sent');
    Toaster::success('Pesan Anda telah dikirim.');
    $this->form->sender = Auth::check() ? Auth::user()->name : '';
    $this->form->contact = Auth::check() ? Auth::user()->email : '';
    $this->form->location = '';
    $this->form->content = '';
};

?>

<x-slot:title>{{ __('Hubungi Kami') }}</x-slot>

<section
    class="std-section flex flex-col space-y-10 min-[950px]:flex-row min-[950px]:items-center min-[950px]:space-x-8 min-[950px]:space-y-0">
    <!-- Contact form -->
    <section class="w-full space-y-6 px-4 sm:px-0 min-[950px]:w-1/2">
        <!-- Header -->
        <div class="text-5xl font-light tracking-tighter">Hubungi kami</div>

        <!-- WhatsApp -->
        <a href="{{ config('const.CONTACT.WHATSAPP_LINK') }}" target="__blank"
            class="smooth group flex w-full items-center justify-center space-x-2 rounded-md bg-[rgb(var(--green-rgb))] px-6 py-2 text-[rgb(var(--white-rgb))] selection:bg-[rgb(var(--white-rgb))] selection:text-[rgb(var(--green-rgb))] hover:opacity-90">
            <x-icons.whats-app-logo class="smooth h-6 w-6 group-hover:-rotate-[20deg]" />
            <div class="text-upperwide text-sm">Chat dengan WhatsApp</div>
        </a>
        <hr class="border-[rgb(var(--fg-rgb))]">

        <!-- Form -->
        <form wire:submit="send" class="relative w-full max-w-full space-y-2 px-0">
            <!-- Sender -->
            <div>
                <x-input-label for="sender" :value="__('Nama')" />
                <x-text-input wire:model="form.sender" id="sender" class="mt-1 block w-full" type="text"
                    name="sender" autofocus autocomplete="username" wire:model.live.debounce.0ms="form.sender" />
                @error('form.sender')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Email address/Phone number -->
            <div>
                <x-input-label for="contact" :value="__('Email/Nomor Telepon')" />
                <x-text-input wire:model="form.contact" id="contact" class="mt-1 block w-full" type="text"
                    name="contact" autocomplete="email" wire:model.live.debounce.0ms="form.contact" />
                @error('form.contact')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('Lokasi')" />
                <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text"
                    name="location" autocomplete="location" wire:model.live.debounce.0ms="form.location" />
                @error('form.location')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Message -->
            <div>
                <x-input-label for="content" :value="__('Pesan')" />
                <x-textarea wire:model="form.content" name="content" id="content"
                    wire:model.live.debounce.0ms="form.content" />
                @error('form.content')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <x-primary-button>
                {{ __('Kirim Pesan') }}
            </x-primary-button>
        </form>
    </section>

    <!-- Contact information -->
    <section class="flex w-full flex-col space-y-6 px-4 sm:px-0 min-[950px]:w-1/2">
        <!-- Map -->
        <div class="overflow-hidden rounded-lg shadow-lg shadow-[rgba(var(--black-rgb),0.1)]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1731981813227!2d106.64529897483607!3d-6.240890561111525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f929b9e6b41d%3A0xad0294b52275fb49!2sChevoil%20Tower!5e0!3m2!1sen!2sid!4v1701534231728!5m2!1sen!2sid"
                style="border:0;" allowfullscreen="" loading="lazy" class="h-[270px] w-full"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Address -->
        <div class="text-inactive tracking-wide">
            @foreach (config('const.CONTACT.ADDRESS') as $line)
                <p>{{ $line }}</p>
            @endforeach
        </div>
        <hr class="border-[rgb(var(--fg-rgb))]">

        <!-- Phone -->
        <div class="text-inactive tracking-wide">
            @foreach (config('const.CONTACT.PHONE') as $number)
                <div class="flex items-center space-x-2">
                    <x-icons.whats-app-logo class="-ml-1 h-6 w-6 fill-[rgba(var(--fg-rgb),0.7)]" />
                    <div>
                        {{ $number }}
                    </div>
                </div>
            @endforeach
            @foreach (config('const.CONTACT.EMAIL') as $email)
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <div>
                        {{ $email }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Directions button -->
        <a href="https://maps.app.goo.gl/h3hiz9ragrb5xsS39" target="__blank">
            <x-secondary-button
                class="flex w-full justify-center !border-[rgb(var(--fg-rgb))] !bg-transparent hover:opacity-80">
                Dapat arahan
            </x-secondary-button>
        </a>
    </section>

</section>
