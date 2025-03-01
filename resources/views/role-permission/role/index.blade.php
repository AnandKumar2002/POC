<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Role') }}
            </h2>
            @can('Create Role')
            {{-- @role('Admin') --}}
            <a href="{{ route('role.create') }}">
                Create
            </a>
            {{-- @endrole --}}
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                            <tr>
                                <th class="py-3 px-4 text-left border-b">ID</th>
                                <th class="py-3 px-4 text-left border-b">Name</th>
                                <th class="py-3 px-4 text-center border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($roles as $role)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b">{{ $role->id }}</td>
                                    <td class="py-3 px-4 border-b">{{ $role->name }}</td>
                                    <td class="py-3 px-4 border-b text-center flex justify-center space-x-5">
                                        <a href="{{ route('role.edit', $role->id) }}"
                                            class="text-green-500 hover:underline"><i class="fa-solid fa-pencil"></i></a>
                                        <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                            class="text-green-500 hover:underline">Role Permission</a>
                                        @can('Delete Role')
                                            <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>