@props(['active'])

@php
$classes = 'navlink text-upperwide block w-full ps-3 pe-4 py-2 border-l-4 ' . ($active ?? false
            ? 'border-[rgb(var(--acc-rgb))] text-start text-sm font-medium text-[rgb(var(--acc-rgb))] bg-[rgba(var(--acc-rgb),0.1)] focus:outline-none focus:text-[rgb(var(--acc-rgb))] focus:bg-[rgb(var(--acc-rgb))] focus:border-[rgb(var(--acc-rgb))] transition duration-150 ease-in-out'
            : 'border-transparent text-start text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
