<a {{ 
    $attributes->merge([
        'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 
                    text-[rgb(var(--bg-rgb))] hover:bg-[rgba(var(--gray-rgb),0.3)] 
                    focus:outline-none focus:bg-[rgba(var(--gray-rgb),0.3)] smooth'
    ]) 
}}
>
    {{ $slot }}
</a>
