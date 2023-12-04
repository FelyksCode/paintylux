<div
    {{ $attributes->merge(['class' => 'flex aspect-square h-[45px] w-[45px] items-center justify-center rounded-full bg-[rgb(var(--fg-rgb))] p-4 text-xl font-bold text-[rgb(var(--bg-rgb))]']) }}>
    {{ $slot }}
</div>
