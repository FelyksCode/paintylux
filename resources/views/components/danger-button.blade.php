<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 
                            bg-[rgb(var(--red-rgb))] opacity-90 border border-transparent 
                            rounded-md font-semibold text-xs text-white 
                            uppercase tracking-widest 
                            hover:opacity-70 active:opacity-100 focus:outline-none 
                            focus:ring-2 focus:ring-[rgb(var(--red-rgb))] focus:ring-offset-2 
                            smooth',
    ]) }}>
    {{ $slot }}
</button>
