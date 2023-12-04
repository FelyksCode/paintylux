@php
    $number = config('const.CONTACT.PHONE')[0];
    $number = str_replace(' ', '', $number);
    $number = str_replace('+', '', $number);
@endphp

<a href="{{ config('const.CONTACT.WHATSAPP_LINK') }}" class="fixed bottom-[60px] right-[50px] z-[10]" target="__blank">
    <x-icons.whats-app-logo
        class="h-[65px] w-[65px] animate-bounce rounded-full bg-[rgb(var(--green-rgb))] p-1 shadow-xl shadow-[rgba(var(--black-rgb),0.4)] [animation-duration:4s]" />
</a>
