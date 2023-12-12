<?php
use App\Models\ProductType;
use function Livewire\Volt\{on, state};

state(['types' => ProductType::allOrdered()]);

on([
    'type-created' => function () {
        $this->types = ProductType::allOrdered();
    },
]);

$delete = function ($id) {
    $type = ProductType::find($id);
    $type->deleteImage();
    $type->delete();
    $this->types = ProductType::allOrdered();
};

?>

<div class="w-full space-y-6">
    <x-header-count :title="__('Semua tipe')" :count="count($this->types)" small />
    @forelse ($this->types as $type)
        <!-- Item -->
        <div
            class="flex flex-col space-y-4 min-[1250px]:flex-row min-[1250px]:items-center min-[1250px]:space-x-4 min-[1250px]:space-y-0">
            <img src="{{ asset(Storage::url($type->image)) }}" alt="{{ $type->name }}"
                class="h-[150px] w-full rounded-md object-scale-down min-[1250px]:w-1/2">
            <div class="w-full space-y-4 min-[1250px]:w-1/2">
                <div>
                    <div class="text-2xl tracking-tighter">{{ $type->name }}</div>
                    <div class="text-inactive text-upperwide">{{ $type->year }}</div>
                </div>
                <hr class="bg-[rgb(var(--fg-rgb))]">
                <div class="flex items-center space-x-3">
                    <x-icons.delete-button class="text-[rgb(var(--red-rgb))]"
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-type-{{ $type->id }}-deletion')" />
                    <a href="{{ route('admin.products.edit.type', ['id' => $type->id]) }}" wire:navigate>
                        <x-icons.edit-button />
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <x-modal name="confirm-type-{{ $type->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
            <div class="p-6">
                <h2 class="text-lg font-medium">
                    {{ __('Apakah Anda yakin ingin menghapus tipe ini?') }}
                </h2>
                <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                    {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                </p>
                <div class="mt-6 flex">
                    <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-primary-button>

                    <x-danger-button class="ms-3" wire:click="delete({{ $type->id }})"
                        x-on:click="$dispatch('close')">
                        {{ __('Hapus Tipe') }}
                    </x-danger-button>
                </div>
            </div>
        </x-modal>
    @empty
        <div class="text-inactive">{{ __('Belum ada tipe.') }}</div>
    @endforelse
</div>
