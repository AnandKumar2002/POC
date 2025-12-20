<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    {{-- Favicon --}}
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    {{-- FluxUI --}}
    @fluxAppearance
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific CSS --}}
    @stack('styles')
</head>

<body class="h-screen flex flex-col bg-white dark:bg-zinc-800 overflow-hidden antialiased">

    <x-layouts.admin.sidebar />

    <x-layouts.admin.header />

    {{-- Main content --}}
    <main role="main" class="flex-1 overflow-y-auto">
        <div class="p-4 md:max-w-5xl md:mx-auto">
            <x-partials.greeting />
            {{ $slot }}
        </div>
    </main>

    @fluxScripts

    {{-- Page-specific JS --}}
    @stack('scripts')

</body>

</html>