@props([
    'greeting' => null,
    'message' => null,
])

@php
    $tz = config('app.timezone', 'UTC');
    $now = now()->timezone($tz)->format('H');

    if ($now >= 5 && $now < 12) {
        $timeGreeting = 'Good morning';
    } elseif ($now >= 12 && $now < 17) {
        $timeGreeting = 'Good afternoon';
    } elseif ($now >= 17 && $now < 21) {
        $timeGreeting = 'Good evening';
    } else {
        $timeGreeting = 'Good night';
    }

    $userName = auth()->user()->name ?? '';
@endphp

<flux:heading size="xl" level="1">
    {{ $greeting ?? "$timeGreeting, $userName" }}
</flux:heading>

<flux:text class="mb-5 mt-2 text-base">
    {{ $message ?? "Here's what's new today" }}
</flux:text>

<flux:separator variant="subtle" class="mb-2" />
