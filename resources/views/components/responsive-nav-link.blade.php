@props(['active'])

@php
    $classes = 'navlink text-upperwide block w-full ps-3 pe-4 py-2 border-l-4 ' . ($active ?? false ? 'border-[rgb(var(--acc-rgb))] text-start text-sm font-medium text-[rgb(var(--acc-rgb))] bg-[rgba(var(--acc-rgb),0.1)] focus:outline-none focus:text-[rgb(var(--acc-rgb))] focus:bg-[rgb(var(--acc-rgb))] focus:border-[rgb(var(--acc-rgb))] transition duration-150 ease-in-out' : 'border-transparent text-start text-sm font-medium text-[rgba(var(--fg-rgb),0.6)] hover:text-[rgb(var(--fg-rgb))] hover:bg-[rgba(var(--fg-rgb),0.4)] hover:border-[rgba(var(--fg-rgb),0.6)] focus:outline-none focus:text-gray-800 focus:bg-[rgba(var(--fg-rgb),0.4)] focus:border-[rgba(var(--fg-rgb),0.6)] transition duration-150 ease-in-out');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
