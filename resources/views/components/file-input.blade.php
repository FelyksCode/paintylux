<x-secondary-button
    {{ $attributes->merge(['class' => 'smooth relative flex w-full cursor-pointer items-center justify-center overflow-hidden !bg-transparent !text-[rgb(var(--fg-rgb))] opacity-80 hover:opacity-100']) }}>
    {{ $slot }}
    <input wire:model="{{ $name }}" id="{{ $name }}" name="{{ $name }}" type="file"
        class="absolute left-0 top-0 mt-1 block h-full w-full scale-[5] cursor-pointer opacity-0" />
</x-secondary-button>
