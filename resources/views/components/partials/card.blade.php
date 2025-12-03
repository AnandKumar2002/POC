@props([
    'title' => null,
    'description' => null,
    'hasActions' => false,
    'class' => '',
])

{{-- Main Container Card --}}
<div {{ $attributes->merge(['class' => "border rounded-md border-gray-200 dark:border-gray-700 overflow-hidden {$class}"]) }}>

    {{-- 1. HEADER SECTION (Title & Description) --}}
    {{-- Conditionally renders if title is provided OR if the named 'header' slot is used. --}}
    @if ($title || isset($header))
        <div class="px-6 py-4 bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            @if ($title)
                <flux:heading size="xl">{{ $title }}</flux:heading>
                @if ($description)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ $description }}
                    </p>
                @endif
            @endif
            {{ $header ?? '' }}
        </div>
    @endif

    {{-- 2. BODY SECTION (Primary Content) --}}
    {{-- This uses the default $slot for the main content area. --}}
    <div class="p-6 space-y-8 bg-white dark:bg-gray-900">
        {{ $slot }}
    </div>

    {{-- 3. FOOTER SECTION (Optional Actions) --}}
    {{-- Renders if 'hasActions' is true OR if the named 'footer' slot is used. --}}
    @if ($hasActions || isset($footer))
        <div class="flex items-center justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 space-x-3">
            {{ $footer ?? '' }}
        </div>
    @endif
</div>