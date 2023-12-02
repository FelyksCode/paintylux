<textarea
    {{ $attributes->merge(['class' => 'resize-none h-[150px] w-full border-[rgb(var(--gray-rgb))] focus:border-[rgb(var(--blue-rgb))] focus:ring-[rgb(var(--blue-rgb))] rounded-md bg-transparent smooth']) }}>
    {{ $slot }}
</textarea>
