<?php

use App\Models\User;

use function Livewire\Volt\layout;

layout('layouts.admin');

?>

<section class="std-section space-y-10 py-5">
    <!-- Header -->
    <section class="space-y-2">
        <x-header-count :title="__('User')" :count="count(User::all())" />
        <div class="text-inactive text-xl">
            {{ __('Kelola pengguna Paintylux.') }}
        </div>
    </section>
</section>
