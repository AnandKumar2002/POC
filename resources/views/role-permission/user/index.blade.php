<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User') }}
            </h2>
            <a href="{{ route('user.create') }}">Create</a>
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
                                <th class="py-3 px-4 text-left border-b">Email</th>
                                <th class="py-3 px-4 text-left border-b">Roles</th>
                                <th class="py-3 px-4 text-center border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b">{{ $user->id }}</td>
                                    <td class="py-3 px-4 border-b">{{ $user->name }}</td>
                                    <td class="py-3 px-4 border-b">{{ $user->email }}</td>
                                    <td class="py-3 px-4 border-b">
                                        @if(!empty($user->roles))
                                        <div class="flex space-x-2">
                                            @foreach ($user->roles as $role)
                                            <label>{{$role->name}}</label>
                                            @endforeach
                                        </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 border-b text-center flex justify-center space-x-5">
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="text-green-500 hover:underline"><i
                                                class="fa-solid fa-pencil"></i></a>

                                        <form action="{{ route('user.destroy', $user->id) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
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
