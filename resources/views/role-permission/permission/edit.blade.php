<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <x-forms.input name='name' placeholder='Permission Name' label="Permission Name" required
                            value="{{ $permission->name }}" />

                        <x-buttons.button type='submit' class="text-white"
                            icon="fa-solid fa-arrow-right-to-bracket mx-auto">
                            Update
                        </x-buttons.button>
                    </form>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
