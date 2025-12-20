{{-- <x-layouts.admin.admin-layout title="Admin Dashboard" description="Manage your platform efficiently"
    keywords="admin,dashboard,analytics" ogImage="https://picsum.photos/id/237/200/300">
    <div>
        I am admin content goes here.
    </div>


</x-layouts.admin.admin-layout> --}}

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
        Welcome to the Main Game Lobby.

        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, totam laborum vel esse aspernatur earum qui dolor quis tempora, distinctio error fugit reiciendis cupiditate expedita obcaecati labore corrupti nulla cum!

        </div>
    </div>
</x-layouts.auth.auth-layout>