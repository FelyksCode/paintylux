@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-[rgb(var(--gray-rgb))] focus:border-[rgb(var(--blue-rgb))] focus:ring-[rgb(var(--blue-rgb))] rounded-md bg-transparent smooth',
]) !!}>
