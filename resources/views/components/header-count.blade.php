@if ($small)
    <div class="flex items-center space-x-3">
        <div class="text-upperwide text-xl">{{ $title }}</div>
        <x-count-ball class="h-[25px] w-[25px] !text-sm">{{ $count }}</x-count-ball>
    </div>
@else
    <div class="flex items-center space-x-6">
        <div class="text-5xl font-light tracking-tighter">{{ $title }}</div>
        <x-count-ball>{{ $count }}</x-count-ball>
    </div>
@endif
