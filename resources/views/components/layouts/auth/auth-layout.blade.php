<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    {{-- Favicon --}}
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- SweetAlert2 --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <header role="banner" class="shrink-0 bg-zinc-100 dark:bg-zinc-900 backdrop-blur-md
               border-b border-zinc-200 dark:border-zinc-700 z-50
               pt-[env(safe-area-inset-top)]">
        {{ $header }}
    </header>

    <main role="main" class="flex-1 overflow-y-auto">
        <div class="p-4 md:max-w-5xl md:mx-auto">
            <x-partials.greeting />
            {{ $slot }}
        </div>
    </main>

    <nav role="navigation" class="shrink-0 bg-zinc-100 dark:bg-zinc-900
               border-t border-zinc-200 dark:border-zinc-800 z-50
               pb-[env(safe-area-inset-bottom)]">
        <x-layouts.auth.bottom-tabs />
    </nav>

    @fluxScripts

    @stack('scripts')

    <x-partials.toaster />

</body>

</html>