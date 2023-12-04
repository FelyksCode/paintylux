<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex justify-center items-center px-4 py-2 bg-[rgb(var(--fg-rgb))] 
                            border border-transparent rounded-md font-semibold text-xs text-[rgb(var(--bg-rgb))] uppercase 
                            tracking-widest hover:bg-[rgba(var(--fg-rgb),0.8)] focus:bg-[rgba(var(--fg-rgb),0.8)] 
                            active:bg-[rgba(var(--fg-rgb),0.9)] focus:outline-none focus:ring-2
                            focus:ring-offset-2 focus:ring-[rgb(var(--fg-rgb))] transition ease-in-out duration-150 w-full',
    ]) }}>
    {{ $slot }}
</button>
