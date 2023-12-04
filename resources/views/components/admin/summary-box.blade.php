<div
    {{ $attributes->merge(['class' => ($light ? 'text-[rgb(var(--bg-rgb))] bg-[rgb(var(--fg-rgb))]' : 'bg-[rgb(var(--acc-rgb))]') . ' w-full rounded-md px-10 py-6 smooth hover:scale-105']) }}>
    {{ $slot }}
</div>
