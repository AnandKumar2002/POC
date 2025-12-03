<x-layouts.admin.admin-layout title="Edit User" description="Edit user details" keywords="users,management,admin"
    ogImage="{{ asset('images/og-default.png') }}">

    <div class="max-w-8xl">

        {{-- The form tag is placed outside the component --}}
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @method('put')
            @csrf

            {{-- Use the reusable card component --}}
            <x-partials.card title="Update User: {{ $user->name }}"
                description="Modify the user's account details and roles.">

                {{-- This content fills the default BODY slot --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- ACCOUNT DETAILS --}}
                    <flux:fieldset>
                        <flux:legend>Account Details</flux:legend>
                        <flux:input name="name" label="Name" icon="user" value="{{ old('name', $user->name) }}"
                            required />
                        {{-- Email is usually disabled for consistency; must be changed elsewhere if required --}}
                        <flux:input name="email" disabled label="Email" type="email" icon="envelope"
                            value="{{ old('email', $user->email) }}" class="cursor-not-allowed" required />
                    </flux:fieldset>

                    {{-- SECURITY DETAILS --}}
                    <flux:fieldset>
                        <flux:legend>Update Password</flux:legend>
                        <flux:input name="password" label="Password" type="password" icon="key"
                            placeholder="Leave blank to keep current password" />
                        <flux:input name="password_confirmation" label="Confirm Password" type="password" icon="key"
                            placeholder="Enter new password again" />
                    </flux:fieldset>

                    {{-- ROLES SELECTION (Full Width) --}}
                    <flux:fieldset class="md:col-span-2">
                        <flux:legend>Roles</flux:legend>
                        <flux:description>Choose the roles for this user.</flux:description>
                        <div class="flex flex-wrap gap-4 pt-2">
                            @foreach ($roles as $role)
                                @php
                                    // Check if the user currently has this role
                                    $checked = $user->hasRole($role->name);
                                @endphp
                                <flux:checkbox :checked="$checked" value="{{ $role->name }}"
                                    label="{{ ucfirst($role->name) }}" name="roles[]" />
                            @endforeach
                        </div>
                    </flux:fieldset>

                </div>

                {{-- This content fills the named FOOTER slot (Action Buttons) --}}
                <x-slot:footer>
                    <flux:button variant="ghost" href="{{ route('users.index') }}" icon="arrow-left"> Back to List
                    </flux:button>
                    <flux:button type="submit" variant="primary" icon="check-circle" class="cursor-pointer">Update User</flux:button>
                </x-slot:footer>

            </x-partials.card>
        </form>
    </div>
</x-layouts.admin.admin-layout>