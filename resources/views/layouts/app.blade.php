<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="min-h-screen">
        <livewire:layout.navigation />
        
        <!-- Page Content -->
        <main class="mt-[var(--navbar-height)] py-4 px-8">
            <!-- Page Heading -->
            {{ $slot }}
        </main>
    </div>
</body>

</html>
