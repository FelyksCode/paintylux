<?php

use App\Models\Project;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'name' => '',
    'year' => '',
    'image' => '',
]);

rules([
    'current_password' => ['required', 'string', 'current_password'],
    'password' => ['required', 'string', Password::defaults(), 'confirmed'],
])->messages([
    'current_password.required' => 'Mohon mengisi password Anda yang sekarang.',
    'current_password.current_password' => 'Password yang Anda isi salah.',
    'password' => 'Password Anda harus minimal 8 karakter.',
    'password.required' => 'Mohon mengisi password Anda yang baru.',
    'password.confirmed' => 'Password baru yang diisi belum sama.',
]);

layout('layouts.admin');

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <div class="text-5xl font-light tracking-tighter">Proyek</div>
        <div class="text-inactive text-xl">
            {{ __('Kelola portofolio proyek yang telah menggunakan Paintylux.') }}
        </div>
    </section>

    <!-- Create new project -->

    <!-- Projects -->
    <section class="space-y-4">
        <x-header-count :title="__('Semua proyek')" :count="count(Project::all())" small />
        @forelse (Project::all() as $project)
            <div>hi</div>
        @empty
            <div class="text-inactive">{{ __('Belum ada proyek.') }}</div>
        @endforelse
    </section>
</section>
