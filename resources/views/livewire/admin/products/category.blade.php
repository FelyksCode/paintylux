<?php
use App\Models\ProductType;
use App\Models\ProductCategory;

use function Livewire\Volt\{on, state};

state(['categories' => ProductCategory::allOrdered()]);

on([
    'category-created' => function () {
        $this->categories = ProductCategory::allOrdered();
    },
]);

$delete = function ($id) {
    ProductCategory::find($id)->delete();
    $this->categories = ProductCategory::allOrdered();
    $this->dispatch('type-deleted');
};

?>

<div class="w-full space-y-6">
    <x-header-count :title="__('Semua kategori')" :count="count($this->categories)" small />
    @forelse ($this->categories as $category)
        <!-- Item -->
        <div
            class="flex w-full flex-col space-y-4 min-[450px]:flex-row min-[450px]:items-center min-[450px]:justify-between min-[450px]:space-y-0">
            <div>
                <div class="text-2xl tracking-tighter">{{ $category->type->name }} {{ $category->container }} <span
                        class="font-bold">{{ $category->weight }} kg</span></div>
                <div class="text-inactive text-upperwide">{{ format_price($category->price) }}</div>
            </div>
            <hr class="block bg-[rgb(var(--fg-rgb))] min-[450px]:hidden">
            <div class="flex items-center space-x-3">
                <x-icons.delete-button class="text-[rgb(var(--red-rgb))]"
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-category-{{ $category->id }}-deletion')" />
                <a href="{{ route('admin.products.edit.category', ['id' => $category->id]) }}" wire:navigate>
                    <x-icons.edit-button />
                </a>
            </div>
        </div>

        <!-- Modal -->
        <x-modal name="confirm-category-{{ $category->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
            <div class="p-6">
                <h2 class="text-lg font-medium">
                    {{ __('Apakah Anda yakin ingin menghapus kategori ini?') }}
                </h2>
                <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                    {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                </p>
                <div class="mt-6 flex">
                    <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-primary-button>

                    <x-danger-button class="ms-3" wire:click="delete({{ $category->id }})"
                        x-on:click="$dispatch('close')">
                        {{ __('Hapus Kategori') }}
                    </x-danger-button>
                </div>
            </div>
        </x-modal>
    @empty
        <div class="text-inactive">{{ __('Belum ada kategori.') }}</div>
    @endforelse
</div>
