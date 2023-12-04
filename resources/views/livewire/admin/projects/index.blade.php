<?php

use App\Models\Project;

use Livewire\WithFileUploads;
use function Livewire\Volt\{layout, rules, state, usesFileUploads};

usesFileUploads();

state([
    'name' => '',
    'year' => '',
    'description' => '',
    'image' => '',
]);

rules([
    'name' => ['required', 'string', 'max:50'],
    'description' => ['string', 'max:150'],
    'year' => ['required', 'integer', 'min:2000', 'max:2100'],
    'image' => ['required', 'image', 'max:2048'],
])->messages([
    'name.required' => 'Mohon mengisi nama proyek.',
    'name.max' => 'Nama proyek yang diisi terlalu panjang.',
    'year.required' => 'Mohon mengisi tahun pelaksanaan proyek.',
    'year.integer' => 'Tahun harus angka bulat.',
    'year.min' => 'Mohon mengisi tahun yang valid.',
    'year.max' => 'Mohon mengisi tahun yang valid.',
    'description.max' => 'Deskripsi yang diisi terlalu panjang.',
    'image.required' => 'Mohon mengunggah gambar proyek.',
    'image.image' => 'File yang diunggah harus berupa gambar.',
    'image.max' => 'Gambar yang diunggah maksimal 2 MB.',
]);

layout('layouts.admin');

$create = function () {
    // Validate
    $validated = $this->validate();

    // Get path and create new project
    $path = $this->image->storePublicly('images/projects', 'public');
    Project::create([
        'name' => $validated['name'],
        'year' => $validated['year'],
        'description' => $validated['description'],
        'image' => $path,
    ]);

    // Clear states
    $this->name = '';
    $this->year = '';
    $this->description = '';
    $this->image = '';
};

$delete = function ($id) {
    Project::find($id)->delete();
};

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <div class="text-5xl font-light tracking-tighter">{{ __('Proyek') }}</div>
        <div class="text-inactive text-xl">
            {{ __('Kelola portofolio proyek yang telah menggunakan Paintylux.') }}
        </div>
    </section>

    <section
        class="flex flex-col space-y-10 min-[800px]:flex-row min-[800px]:justify-between min-[800px]:space-x-10 min-[800px]:space-y-0">
        <!-- Create new project -->
        <section class="w-full space-y-4">
            <div class="text-upperwide text-xl">{{ __('Tambahkan Proyek') }}</div>
            <form wire:submit="create" class="w-full max-w-full space-y-4 px-0" enctype="multipart/form-data">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Proyek')" />
                    <x-text-input wire:model="name" id="name" name="name" type="text"
                        class="mt-1 block w-full" autocomplete="project-name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Year -->
                <div>
                    <x-input-label for="year" :value="__('Tahun')" />
                    <x-text-input wire:model="year" id="year" name="year" type="number"
                        class="mt-1 block w-full" autocomplete="year" />
                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                </div>

                <!-- Image -->
                <div>
                    <x-input-label for="image" :value="__('Gambar')" />
                    <input wire:model="image" type="file" id="image" name="image"
                        class="mt-1 w-full rounded-md text-sm">
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <div class="flex items-center space-x-2">
                        <x-input-label for="description" :value="__('Deskripsi Singkat')" />
                        <div class="text-inactive text-upperwide text-[10px] font-bold">Opsional</div>
                    </div>
                    <x-textarea wire:model="description" name="description" id="description"
                        wire:model.live.debounce.0ms="description" class="mt-1 h-[100px]" />
                    @error('description')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <x-primary-button>
                    {{ __('Tambah') }}
                </x-primary-button>
            </form>
        </section>

        <!-- Projects -->
        <section class="w-full space-y-6">
            <x-header-count :title="__('Semua proyek')" :count="count(Project::all())" small />
            @forelse (Project::all() as $project)
                <!-- Item -->
                <div
                    class="flex flex-col space-y-4 min-[1250px]:h-[250px] min-[1250px]:flex-row min-[1250px]:items-center min-[1250px]:space-x-4 min-[1250px]:space-y-0">
                    <img src="{{ asset(Storage::url($project->image)) }}" alt="{{ $project->name }}"
                        class="h-[150px] w-full rounded-md object-cover min-[1250px]:h-full min-[1250px]:w-1/2">
                    <div class="w-full space-y-4 min-[1250px]:w-1/2">
                        <div>
                            <div class="text-2xl tracking-tighter">{{ $project->name }}</div>
                            <div class="text-inactive text-upperwide">{{ $project->year }}</div>
                        </div>
                        <hr class="bg-[rgb(var(--fg-rgb))]">
                        <div>
                            @if ($project->description)
                                {{ $project->description }}
                            @else
                                {{ __('Tidak ada deskripsi.') }}
                            @endif
                        </div>
                        <div class="flex items-center space-x-3">
                            <x-icons.delete-button class="text-[rgb(var(--red-rgb))]"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-project-{{ $project->id }}-deletion')" />
                            <a href="{{ route('admin-projects.edit', ['id' => $project->id]) }}" wire:navigate>
                                <x-icons.edit-button />
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <x-modal name="confirm-project-{{ $project->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                    <div class="p-6">
                        <h2 class="text-lg font-medium">
                            {{ __('Apakah Anda yakin ingin menghapus proyek ini?') }}
                        </h2>
                        <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                            {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                        </p>
                        <div class="mt-6 flex">
                            <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                                {{ __('Batal') }}
                            </x-primary-button>

                            <x-danger-button class="ms-3" wire:click="delete({{ $project->id }})"
                                x-on:click="$dispatch('close')">
                                {{ __('Hapus Proyek') }}
                            </x-danger-button>
                        </div>
                    </div>
                </x-modal>
            @empty
                <div class="text-inactive">{{ __('Belum ada proyek.') }}</div>
            @endforelse
        </section>
    </section>
</section>
