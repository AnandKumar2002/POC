<x-layouts.admin.admin-layout title="Create Role" description="Define a new user role and assign permissions"
    keywords="roles,permissions,create,admin">

    <div class="max-w-8xl">

        {{-- The form tag is placed outside the component for the entire content --}}
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            {{-- Use the reusable card component --}}
            <x-partials.card title="Create New Role"
                description="Define the role name and select the initial permissions for this role.">

                {{-- This content fills the default BODY slot --}}
                <div class="space-y-8">

                    {{-- Role Name Input --}}
                    <div>
                        <flux:input name="name" icon="user-group"
                            placeholder="Enter role name (e.g., admin, manager, editor)" label="Role Name"
                            class="w-full" :value="old('name')" required />
                    </div>

                    <flux:separator />

                    {{-- Permissions Group Title --}}
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Manage Permissions
                    </h3>

                    {{-- Permissions Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($permissionGroups as $groupName => $permissions)
                            <div
                                class="bg-gray-100 dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-700">

                                <flux:checkbox.group class="text-gray-900 dark:text-white">
                                    <div class="flex items-center">
                                        {{-- Checkbox to select/deselect all in this group --}}
                                        <flux:checkbox.all />
                                        <flux:legend class="px-2 font-bold text-lg">{{ Str::title($groupName) }}
                                        </flux:legend>
                                    </div>
                                    <flux:separator class="my-2 dark:border-gray-600" />
                                    <div class="flex flex-col space-y-2">
                                        @foreach ($permissions as $permission)
                                            @php
                                                // Check for old input if validation fails
                                                $checked = old('permissions') ? in_array($permission->name, old('permissions')) : false;
                                            @endphp
                                            <flux:checkbox
                                                label="{{ Str::title(str_replace(['_', '-'], ' ', $permission->name)) }}"
                                                value="{{ $permission->name }}" name="permissions[]" :checked="$checked"
                                                class="text-gray-900 dark:text-white" />
                                        @endforeach
                                    </div>
                                </flux:checkbox.group>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- This content fills the named FOOTER slot (Action Buttons) --}}
                <x-slot:footer>
                    <flux:button variant="ghost" href="{{ route('roles.index') }}" icon="arrow-left">Back to List
                    </flux:button>
                    <flux:button type="submit" variant="primary" icon="plus" class="cursor-pointer">Create Role
                    </flux:button>
                </x-slot:footer>

            </x-partials.card>
        </form>
    </div>
</x-layouts.admin.admin-layout>