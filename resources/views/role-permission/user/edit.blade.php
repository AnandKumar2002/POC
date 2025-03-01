<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="grid lg:grid-cols-2 lg:space-x-4">
                            <x-forms.input name='name' placeholder='Name' label="Name" required
                                value="{{ $user->name }}" />
                            <x-forms.input name='email' placeholder='Email' label="Email" required
                                value="{{ $user->email }}" />
                        </div>
                        <div class="grid lg:grid-cols-2 lg:space-x-4">
                            <x-forms.input name='password' placeholder='New Password (Leave blank to keep current)'
                                label="New Password" />
                            <x-forms.input name='password_confirmation' placeholder='Confirm New Password'
                                label="Confirm New Password" />
                        </div>

                        <div class="grid">
                            <x-forms.select-box name="roles[]" label='Roles' placeholder='Select an option' required multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                                @endforeach
                            </x-forms.select-box>
                        </div>

                        <x-buttons.button type='submit' class="text-white"
                            icon="fa-solid fa-arrow-right-to-bracket mx-auto">
                            Save
                        </x-buttons.button>
                    </form>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
