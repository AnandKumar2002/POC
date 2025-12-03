<x-layouts.admin.admin-layout title="User Details" description="View user profile" keywords="users,view,profile,admin"
    ogImage="{{ asset('images/og-default.png') }}">

    <div class="max-w-8xl">

        {{-- Use the reusable card component --}}
        <x-partials.card title="User Profile: {{ $user->name }}"
            description="Detailed information about this user's account and roles.">

            {{-- This content fills the default BODY slot --}}
            <div class="space-y-6">

                {{-- Section 1: Top Display (Avatar and Name) --}}
                {{-- Border added for visual separation in the body area --}}
                <div class="border-b pb-4 border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <flux:avatar name="{{ $user->name }}" size="lg" />
                        <div>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            <p class="text-md text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Section 2: User Info Grid (Read-Only Fields) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input name="name" label="Full Name" icon="user" value="{{ $user->name }}" readonly />
                    <flux:input name="email" label="Primary Email" icon="envelope" value="{{ $user->email }}"
                        readonly />
                </div>

                {{-- Section 3: Roles Display --}}
                <flux:fieldset>
                    <flux:legend>Roles</flux:legend>
                    <flux:description>Assigned permissions and roles:</flux:description>
                    <div class="flex flex-wrap gap-3 pt-2">
                        @forelse ($user->roles as $role)
                            {{-- Using Indigo shades for visually distinct roles --}}
                            <span
                                class="px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm font-medium text-indigo-800 dark:text-indigo-200 border border-indigo-300 dark:border-indigo-700">
                                {{ ucfirst($role->name) }}
                            </span>
                        @empty
                            <p class="text-sm text-gray-500 italic">No roles assigned.</p>
                        @endforelse
                    </div>
                </flux:fieldset>

            </div>

            {{-- This content fills the named FOOTER slot (Action Buttons) --}}
            <x-slot:footer>
                <flux:button variant="ghost" href="{{ route('users.index') }}" icon="arrow-left">Back to List</flux:button>
                <flux:button variant="primary" href="{{ route('users.edit', $user->id) }}" icon="pencil" class="cursor-pointer">Edit User
                </flux:button>
            </x-slot:footer>

        </x-partials.card>
    </div>
</x-layouts.admin.admin-layout>