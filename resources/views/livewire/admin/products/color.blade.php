<?php
use App\Models\Color;
use function Livewire\Volt\{on, state};

state(['colors' => Color::allOrdered()]);

on([
    'color-created' => function () {
        $this->colors = Color::allOrdered();
    },
]);

$delete = function ($id) {
    Color::find($id)->delete();
    $this->colors = Color::allOrdered();
};

?>

<div class="w-full space-y-6" wire:color-created="$refresh">
    <x-header-count :title="__('Semua warna')" :count="count($this->colors)" small />
    <div class="max-h-[300px] space-y-6 overflow-y-scroll">
        @forelse ($this->colors as $color)
            <!-- Item -->
            <div
                class="flex flex-col space-y-4 min-[850px]:flex-row min-[850px]:items-center min-[850px]:space-x-4 min-[850px]:space-y-0">
                <div class="h-[100px] w-full rounded-md min-[850px]:w-1/2" style="background-color: #{{ $color->hex }}">
                </div>
                <div class="w-full space-y-4 min-[850px]:w-1/2">
                    <div>
                        <div class="text-2xl tracking-tighter">{{ $color->name }}</div>
                        <div class="text-inactive text-upperwide">{{ $color->year }}</div>
                    </div>
                    <hr class="bg-[rgb(var(--fg-rgb))]">
                    <div class="flex items-center space-x-3">
                        <x-icons.delete-button class="text-[rgb(var(--red-rgb))]"
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-color-{{ $color->id }}-deletion')" />
                        <a href="{{ route('admin.products.edit.color', ['id' => $color->id]) }}" wire:navigate>
                            <x-icons.edit-button />
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <x-modal name="confirm-color-{{ $color->id }}-deletion" :show="$errors->isNotEmpty()" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin menghapus warna ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Anda tidak dapat mengembalikan perubahan ini.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3" wire:click="delete({{ $color->id }})"
                            x-on:click="$dispatch('close')">
                            {{ __('Hapus Warna') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @empty
            <div class="text-inactive">{{ __('Belum ada warna.') }}</div>
        @endforelse
    </div>
</div>
