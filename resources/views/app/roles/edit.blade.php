<x-layouts.admin.admin-layout title="Edit Role" description="Manage permissions for role"
    keywords="roles,permissions,admin">

    <div class="max-w-8xl">

        {{-- The form tag is placed outside the component for the entire content --}}
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Use the reusable card component --}}
            <x-partials.card title="Edit Role: {{ $role->name }}"
                description="Update the name and manage the permissions assigned to this role.">

                {{-- This content fills the default BODY slot --}}
                <div class="space-y-8">

                    {{-- Role Name Input --}}
                    <div>
                        <flux:input name="name" label="Role Name" icon="user-group"
                            value="{{ old('name', $role->name) }}"
                            placeholder="Enter role name (e.g., admin, manager, editor)" class="w-full" required />
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
                                                // Check if the current role has this permission
                                                $checked = old('permissions')
                                                    ? in_array($permission->name, old('permissions'))
                                                    : $role->hasPermissionTo($permission);
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
                    <flux:button variant="ghost" href="{{ route('roles.index') }}" icon="arrow-left"> Back to List
                    </flux:button>
                    <flux:button type="submit" variant="primary" icon="check-circle" class="cursor-pointer">
                        Update Role</flux:button>
                </x-slot:footer>

            </x-partials.card>
        </form>
    </div>
</x-layouts.admin.admin-layout>