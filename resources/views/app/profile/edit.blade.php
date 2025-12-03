<x-layouts.admin.admin-layout title="My Profile" description="View and manage your account information.">

    <div class="max-w-8xl">

        {{-- Update Profile Form --}}
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <x-partials.card title="Edit Account Details" description="Update your name, email, and password.">

                <div class="space-y-8">

                    {{-- Personal Information --}}
                    <flux:fieldset>
                        <flux:legend>Personal Information</flux:legend>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <flux:input name="name" label="Full Name" value="{{ old('name', $user->name) }}" icon="user"
                                required placeholder="Your full name" />

                            <flux:input name="email" label="Email Address" type="email"
                                value="{{ old('email', $user->email) }}" icon="envelope" required readonly
                                placeholder="Your primary email address" />
                        </div>
                    </flux:fieldset>

                    {{-- Password Update --}}
                    <flux:fieldset>
                        <flux:legend>Update Password</flux:legend>
                        <flux:description>Leave these fields blank to keep your current password.</flux:description>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <flux:input name="password" viewable label="New Password" type="password" icon="key"
                                placeholder="Minimum 8 characters" />

                            <flux:input name="password_confirmation" viewable label="Confirm New Password"
                                icon="key" type="password" placeholder="Re-enter the new password" />
                        </div>
                    </flux:fieldset>
                </div>

                <x-slot:footer>
                    <flux:button type="submit" variant="primary" class="cursor-pointer inline-flex items-center">
                        <i class="fas fa-check-circle mr-2"></i> Update Profile
                    </flux:button>
                </x-slot:footer>

            </x-partials.card>
        </form>

        <flux:separator variant="subtle" class="my-2" />

        {{-- Danger Zone --}}
        <x-partials.card title="Danger Zone" description="Permanently delete your user account."
            class="border-red-500 dark:border-red-700">

            <div class="flex justify-between items-center py-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Once you delete your account, all your data will be permanently lost.
                </p>

                {{-- Use reusable modal trigger --}}
                <x-partials.confirmation-modal-trigger name="delete-account" text="Delete Account" variant="danger"
                    icon="trash" />
            </div>

        </x-partials.card>

        {{-- Reusable Confirmation Modal --}}
        <x-partials.confirmation-modal name="delete-account" title="Are you sure?"
            message="Please enter your password to permanently delete your account.">
            <livewire:delete-account />
        </x-partials.confirmation-modal>

    </div>

</x-layouts.admin.admin-layout>