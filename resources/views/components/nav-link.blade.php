@props(['active'])

@php
    $classes = 'navlink text-upperwide smooth inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 ' . (
        ($active ?? false )
        ? 'border-[rgb(var(--acc-rgb))] text-[rgb(var(--acc-rgb))] focus:outline-none focus:border-[rgb(var(--acc-rgb))]' 
        : 'border-transparent text-[rgba(var(--fg-rgb),0.6)] hover:text-[rgb(var(--fg-rgb))] hover:border-[rgb(var(--fg-rgb))] focus:outline-none focus:text-[rgb(var(--fg-rgb))] focus:border-[rgb(var(--fg-rgb))]'
    );
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
