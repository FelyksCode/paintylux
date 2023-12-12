<?php
use App\Models\ProductType;
use App\Models\Color;
use App\Models\Project;

?>

<x-app-layout>
    <section class="std-section space-y-16 overflow-x-hidden">
        <div class="absolute left-0 top-[50px] z-[-1] opacity-70 min-[700px]:top-0">
            <div
                class="pulse flex aspect-square h-[150px] w-[150px] items-center justify-center rounded-full border border-[rgb(var(--acc-rgb))] min-[500px]:h-[300px] min-[500px]:w-[300px] min-[700px]:h-[500px] min-[700px]:w-[500px]">
                <div
                    class="pulse flex aspect-square h-[100px] w-[100px] items-center justify-center rounded-full border border-[rgb(var(--acc-rgb))] delay-[50ms] min-[500px]:h-[200px] min-[500px]:w-[200px] min-[700px]:h-[300px] min-[700px]:w-[300px]">
                    <div
                        class="pulse aspect-square h-[50px] w-[50px] rounded-full border border-[rgb(var(--acc-rgb))] delay-100 min-[500px]:h-[100px] min-[500px]:w-[100px] min-[700px]:h-[150px] min-[700px]:w-[150px]">
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex w-full flex-col items-center space-y-2 opacity-0 min-[600px]:h-[350px] min-[600px]:flex-row min-[600px]:justify-center min-[600px]:space-x-14 min-[600px]:space-y-0"
            x-intersect="$el.classList.add('float-in-up')">
            <!-- Hero -->
            <img src="{{ asset('assets/hero.png') }}" alt="Paint Bucket"
                class="float z-[1] w-[200px] min-[1000px]:w-[250px] min-[1300px]:w-[300px]">

            <!-- Welcome -->
            <div class="relative flex flex-col space-y-4 min-[600px]:space-y-8">
                <div>
                    <div
                        class="text-center text-3xl font-light tracking-tighter min-[600px]:text-left min-[1300px]:text-4xl">
                        {{ __('Welcome to') }}
                    </div>
                    <x-application-logo class="w-[300px] min-[1000px]:w-[400px] min-[1300px]:w-[600px]" />
                </div>
                <a wire:navigate href="{{ route('products') }}"
                    class="smooth group flex w-fit items-center space-x-2 rounded-xl border border-[rgb(var(--acc-rgb))] px-8 py-2 text-[rgb(var(--acc-rgb))] hover:opacity-80">
                    <div
                        class="text-upperwide smooth text-lg opacity-90 group-hover:tracking-[0.15em] group-hover:opacity-100">
                        {{ __('Lihat produk kami') }}
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="smooth h-5 w-5 opacity-90 group-hover:-rotate-90 group-hover:opacity-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Types -->
        <div class="flex flex-col items-center text-center font-light tracking-tighter">
            <div class="mb-4 max-w-[600px] text-2xl opacity-0 min-[1300px]:text-3xl"
                x-intersect="$el.classList.add('float-in-up')">
                {{ __('Cat tembok berkualitas tinggi yang menyesuaikan dengan kebutuhan Anda') }}
            </div>
            <div class="mb-16 grid grid-cols-4 gap-4 opacity-0 min-[600px]:grid-cols-8"
                x-intersect="$el.classList.add('float-in-up')">
                @php
                    $colors = Color::allOrdered()->take(8);
                    $colorsCount = $colors->count();
                @endphp
                @unless ($colorsCount < 1)
                    @for ($i = 0; $i < $colorsCount < 8 ? $colorsCount : 8; $i++)
                        <div class="h-[40px] w-[40px] rounded-full shadow-lg shadow-[rgba(var(--fg-rgb),0.4)] min-[400px]:h-[60px] min-[400px]:w-[60px]"
                            style="background-color: #{{ $colors[$i]->hex }}">
                        </div>
                    @endfor
                @endunless
            </div>
            <div class="grid grid-cols-1 gap-4 min-[600px]:grid-cols-3">
                @foreach (ProductType::allOrdered() as $type)
                    <div class="opacity-0" x-intersect="$el.classList.add('float-in-up')">
                        <a href="{{ route('products.type', ['slug' => $type->slug()]) }}"
                            class="smooth min-[400px]: flex flex-col items-center space-y-4 brightness-[0.6] hover:scale-105 hover:brightness-100 min-[1000px]:space-y-8"
                            wire:navigate>
                            <div
                                class="flex h-full w-fit items-center justify-center rounded-xl border border-[rgb(var(--fg-rgb))] px-8 py-4 min-[600px]:h-[150px]">
                                <img src="{{ asset(Storage::url($type->image)) }}" alt="{{ __($type->name) }}"
                                    class="float h-full w-full min-[300px]:w-[150px] min-[600px]:h-auto min-[1000px]:w-[200px]"
                                    loading="lazy" style="animation-duration: {{ 6 + $loop->index }}s">
                            </div>
                            <div class="text-upperwide text-center text-lg min-[1000px]:text-xl">
                                {{ __($type->name) }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Projects -->
        <div class="flex flex-col items-center space-y-6 text-center text-3xl font-light tracking-tighter">
            <div class="max-w-[600px] text-2xl opacity-0 min-[1300px]:text-3xl"
                x-intersect="$el.classList.add('float-in-up')">
                {{ __('Telah dipercaya banyak mitra sejak 2004') }}
            </div>
            <div class="grid w-fit grid-cols-1 gap-4 min-[600px]:grid-cols-3">
                @php
                    $projects = Project::allOrdered();
                    $projectsCount = $projects->count();
                @endphp
                @foreach ($projects->take(3) as $project)
                    <div class="flex flex-col items-center space-y-2 opacity-0"
                        x-intersect="$el.classList.add('float-in-up')">
                        <img src="{{ asset(Storage::url($project->image)) }}" alt="{{ $project->name }}"
                            class="h-[200px] w-[200px] rounded-xl object-cover min-[1000px]:h-[250px] min-[1000px]:w-[250px]"
                            loading="lazy">
                        <div
                            class="text-upperwide max-w-[250px] text-center text-lg leading-5 min-[1000px]:max-w-[300px] min-[1000px]:text-xl">
                            {{ $project->name }}
                        </div>
                    </div>
                @endforeach
            </div>
            <a wire:navigate href="{{ route('projects') }}"
                class="text-link smooth group flex w-fit items-center space-x-2 opacity-0 hover:opacity-80"
                x-intersect="$el.classList.add('float-in-up')">
                <div
                    class="text-upperwide smooth text-lg opacity-90 group-hover:tracking-[0.15em] group-hover:opacity-100">
                    {{ __('Lihat ' . ($projectsCount > 3 ? $projectsCount - 3 . ' ' : '') . 'proyek lainnya') }}
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="smooth h-5 w-5 opacity-90 group-hover:-rotate-90 group-hover:opacity-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>
</x-app-layout>
