<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Role Permission ( {{$role->name}} )
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Permissions</h1>
                        <form action="{{ route('roles.give-permissions', $role->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')                    
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="permission_{{ $permission->id }}" 
                                            name="permission[]" value="{{ $permission->name }}" 
                                            class="rounded border-gray-300 focus:ring-indigo-500"
                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                        <label for="permission_{{ $permission->id }}" class="text-gray-700">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <x-buttons.button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
                                    <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Update
                                </x-buttons.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
