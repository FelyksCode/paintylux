@if ($small)
    <div {{ $attributes->merge(['class' => 'flex items-center space-x-3']) }}>
        <div class="text-upperwide text-xl">{{ $title }}</div>
        <x-count-ball class="h-[25px] w-[25px] !text-sm">{{ $count }}</x-count-ball>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'flex items-center space-x-4 min-[300px]:space-x-6']) }}>
        <div class="text-4xl font-light tracking-tighter min-[300px]:text-5xl">{{ $title }}</div>
        <x-count-ball>{{ $count }}</x-count-ball>
    </div>
@endif
