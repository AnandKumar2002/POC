<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="grid lg:grid-cols-2 lg:space-x-4">
                            <x-forms.input name='name' placeholder='Name' label="Name" required />
                            <x-forms.input name='email' placeholder='Email' label="Email" required />
                        </div>
                        <div class="grid lg:grid-cols-2 lg:space-x-4">
                            <x-forms.input type="password" name='password' placeholder='Password' label="Password"
                                required />
                            <x-forms.input type="password" name='password_confirmation' placeholder='Confirm Password'
                                label="Confirm Password" required />
                        </div>

                        <div class="grid">
                            <x-forms.select-box name="roles[]" label='Roles' placeholder='Select an option' required multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </x-forms.select-box>
                        </div>

                        <x-buttons.button type='submit' class="text-white"
                            icon="fa-solid fa-arrow-right-to-bracket mx-auto">
                            Submit
                        </x-buttons.button>
                    </form>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>