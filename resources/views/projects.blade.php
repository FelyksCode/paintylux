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
                    Lihat semua
                </div>
                <div class="mb-3 text-7xl font-light tracking-tighter min-[500px]:text-9xl">
                    Projek
                </div>
            </div>
            <hr class="border border-[rgb(var(--fg-rgb))]">
            <div class="text-xl font-light min-[500px]:text-2xl">
                Sudah ada lebih dari {{ Project::all()->count() }} proyek yang menggunakan Paintylux.
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
                {{-- <div
                    class="group relative h-[250px] w-full overflow-hidden rounded-xl px-8 py-6 text-[rgb(var(--white-rgb))]">
                    <div class="smooth text-3xl font-light tracking-tighter group-hover:opacity-0">
                        {{ $project->name }}
                    </div>
                    <div class="text-upperwide smooth smooth text-xl font-medium opacity-75 group-hover:opacity-0">
                        {{ $project->year }}
                    </div>
                    <img src="{{ asset(Storage::url($project->image)) }}" alt="{{ $project->name }}"
                        class="smooth absolute left-0 top-0 z-[-1] h-full w-full object-cover brightness-50 group-hover:brightness-100">
                </div> --}}
            @endforeach
        </div>
    </section>
</x-app-layout>
