<x-layouts.auth.auth-layout>
    <x-slot:header>
        {{-- <x-layouts.auth.header-primary :title="'Tournament'" :titleHref="'game'" :actions="[
        [
            'type' => 'badge',
            'badge_color' => 'blue',
            'icon' => 'bell',
            'action' => 'toggleSearch',
            'label' => 'Offline'
        ],
        [
            'type' => 'badge',
            'badge_color' => 'blue',
            'href' => '/game',
            'label' => '100 Credits'
        ],
        [
            'image' => auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=User',
            'action' => 'openProfile',
        ]]" /> --}}
        <x-layouts.auth.header-secondary title="Edit Profile" back-href="/dashboard" :actions="[
        ['icon' => 'check', 'action' => 'saveProfile', 'color' => 'primary']
    ]" />
    </x-slot:header>
    <div class="">
        Welcome to auth dashboard.
    </div>
</x-layouts.auth.auth-layout>