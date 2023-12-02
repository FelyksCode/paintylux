@php
    $number = config('const.CONTACT.PHONE')[0];
    $number = str_replace(' ', '', $number);
    $number = str_replace('+', '', $number);
@endphp

<a href="https://wa.me/{{ $number }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20Paintylux."
    class="fixed bottom-[60px] right-[50px] z-[10]" target="__blank">
    <x-whats-app-logo
        class="h-[65px] w-[65px] animate-bounce rounded-full bg-[rgb(var(--green-rgb))] p-1 shadow-xl shadow-[rgba(var(--black-rgb),0.4)] [animation-duration:4s]" />
</a>
