<?php

use App\Models\Project;

use function Livewire\Volt\{mount, layout, rules, state, usesFileUploads};

usesFileUploads();

state(['project' => fn($id) => Project::findOrFail($id)])->locked();

state(['name', 'year', 'description', 'image', 'current_image']);

mount(function () {
    $this->name = $this->project->name;
    $this->year = $this->project->year;
    $this->description = $this->project->description;
    $this->current_image = $this->project->image;
});

rules([
    'name' => ['required', 'string', 'max:50'],
    'description' => ['string', 'max:150'],
    'year' => ['required', 'integer', 'min:2000', 'max:2100'],
    'image' => ['image', 'max:2048', 'nullable'],
])->messages([
    'name.required' => 'Mohon mengisi nama proyek.',
    'name.max' => 'Nama proyek yang diisi terlalu panjang.',
    'year.required' => 'Mohon mengisi tahun pelaksanaan proyek.',
    'year.integer' => 'Tahun harus angka bulat.',
    'year.min' => 'Mohon mengisi tahun yang valid.',
    'year.max' => 'Mohon mengisi tahun yang valid.',
    'description.max' => 'Deskripsi yang diisi terlalu panjang.',
    'image.image' => 'File yang diunggah harus berupa gambar.',
    'image.max' => 'Gambar yang diunggah maksimal 2 MB.',
]);

layout('layouts.admin');

$update = function () {
    // Validate
    $validated = $this->validate();

    // Update project
    $this->project->update([
        'name' => $validated['name'],
        'year' => $validated['year'],
        'description' => $validated['description'],
    ]);

    // If new image is uploaded remove current image and store new one
    if ($validated['image']) {
        $this->project->deleteImage();
        $this->project->update([
            'image' => $this->image->storePublicly('images/projects', 'public'),
        ]);
    }

    // Redirect back to index
    return $this->redirect(route('admin.projects'), navigate: true);
};

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <div class="flex items-center space-x-4">
            <x-icons.back-button :link="route('admin.projects')" class="h-11 w-11" />
            <div>
                <div class="text-4xl font-light tracking-tighter min-[600px]:text-5xl">{{ __('Edit Proyek ') }}<strong
                        class="font-bold">{{ $name }}</strong></div>
                <div class="text-inactive text-lg min-[600px]:text-xl">
                    {{ __('Ubah informasi mengenai proyek ini.') }}
                </div>
            </div>
        </div>
    </section>

    <!-- Create new project -->
    <section
        class="flex flex-col space-y-10 min-[1000px]:h-[400px] min-[1000px]:flex-row min-[1000px]:items-center min-[1000px]:space-x-10 min-[1000px]:space-y-0">
        <img src="{{ asset(Storage::url($this->current_image)) }}" alt="{{ $this->name }}"
            class="h-[250px] rounded-xl object-cover min-[1000px]:h-full min-[1000px]:w-1/2">
        <form wire:submit="update" class="w-full max-w-full space-y-4" enctype="multipart/form-data">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Proyek')" />
                <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full"
                    autocomplete="project-name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Year -->
            <div>
                <x-input-label for="year" :value="__('Tahun')" />
                <x-text-input wire:model="year" id="year" name="year" type="number" class="mt-1 block w-full"
                    autocomplete="year" />
                <x-input-error :messages="$errors->get('year')" class="mt-2" />
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="image" :value="__('Ganti Gambar')" />
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
                {{ __('Ubah') }}
            </x-primary-button>
        </form>
    </section>
</section>
