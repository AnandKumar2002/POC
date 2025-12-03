<x-layouts.admin.admin-layout title="Users" description="Manage your users efficiently"
    keywords="users,management,admin" ogImage="{{ asset('images/og-default.png') }}">

    <div class="max-w-8xl">

        {{-- The form tag is placed outside the component for flexibility --}}
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <x-partials.card title="Create User" description="Enter the new user's details and assign their roles.">

                {{-- This content fills the default BODY slot --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- ACCOUNT DETAILS --}}
                    <flux:fieldset>
                        <flux:legend>Account Details</flux:legend>
                        <flux:input name="name" label="Name" icon="user" value="{{ old('name') }}"
                            placeholder="e.g., Jane Doe" required />
                        <flux:input name="email" label="Email" icon="envelope" type="email" value="{{ old('email') }}"
                            placeholder="e.g., jane.doe@example.com" required />
                    </flux:fieldset>

                    {{-- SECURITY DETAILS --}}
                    <flux:fieldset>
                        <flux:legend>Set Password</flux:legend>
                        <flux:input name="password" label="Password" type="password" icon="key" required
                            placeholder="Must be at least 8 characters" />
                        <flux:input name="password_confirmation" label="Confirm Password" type="password" icon="key"
                            required placeholder="Re-enter the password" />
                    </flux:fieldset>

                </div>

                {{-- ROLES SELECTION (Full Width) --}}
                <flux:fieldset>
                    <flux:legend>Roles</flux:legend>
                    <flux:description>Select one or more roles for this user.</flux:description>
                    <div class="flex flex-wrap gap-4 pt-2">
                        @foreach ($roles as $role)
                            <flux:checkbox value="{{ $role->name }}" name="roles[]" label="{{ ucfirst($role->name) }}"
                                :checked="in_array($role->name, old('roles', []))" />
                        @endforeach
                    </div>
                </flux:fieldset>

                {{-- This content fills the named FOOTER slot --}}
                <x-slot:footer>
                    <flux:button variant="ghost" href="{{ route('users.index') }}" icon="arrow-left">Back to List
                    </flux:button>
                    <flux:button type="submit" variant="primary" class="cursor-pointer" icon="plus">
                        Create User</flux:button>
                </x-slot:footer>

            </x-partials.card>
        </form>
    </div>
</x-layouts.admin.admin-layout>