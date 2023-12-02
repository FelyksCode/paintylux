<x-app-layout>
    <section class="std-section">
        <div class="mb-8 text-5xl font-light tracking-tighter">Hubungi kami</div>
        <form action="" class="space-y-2">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="text" name="email"
                    autofocus autocomplete="username" wire:model.live.debounce.0ms="form.email" />
                @error('form.email')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="text"
                    name="email" autofocus autocomplete="username" wire:model.live.debounce.0ms="form.email" />
                @error('form.email')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="text"
                    name="email" autofocus autocomplete="username" wire:model.live.debounce.0ms="form.email" />
                @error('form.email')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
        </form>
    </section>
</x-app-layout>
