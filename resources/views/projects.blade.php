@php
    use App\Models\Project;
@endphp

<x-app-layout>
    <x-slot:title>{{ __('Proyek') }}</x-slot>
    <section
        class="std-section flex flex-col space-y-6 py-4 min-[1100px]:flex-row min-[1100px]:space-x-16 min-[1100px]:space-y-0">
        <!-- Title -->
        <div class="space-y-8">
            <div class="space-y-1 min-[1100px]:mr-[100px]">
                <div class="text-upperwide text-inactive text-xl min-[500px]:text-3xl">
                    {{ __('Lihat Semua') }}
                </div>
                <div class="mb-3 text-7xl font-light tracking-tighter min-[500px]:text-9xl">
                    {{ __('Proyek') }}
                </div>
            </div>
            <hr class="border border-[rgb(var(--fg-rgb))]">
            <div class="text-xl font-light min-[500px]:text-2xl">
                {{ __('Sudah ada lebih dari ' . Project::all()->count() . ' proyek yang menggunakan Paintylux.') }}
            </div>
        </div>

        <!-- Projects -->
        <div class="w-full space-y-6 overflow-y-scroll min-[1100px]:max-h-[600px]">
            @foreach (Project::allOrdered() as $project)
                <div class="space-y-2" x-intersect="$el.classList.add('float-in-up')">
                    <img src="{{ asset(Storage::url($project->image)) }}" alt="{{ $project->name }}"
                        class="smooth h-[250px] w-full rounded-xl object-cover" loading="lazy">
                    <div class="">
                        <div class="text-3xl tracking-tighter">{{ $project->name }}</div>
                        <div class="text-upperwide text-inactive text-xl font-medium">{{ $project->year }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
