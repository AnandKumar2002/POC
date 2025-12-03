<x-layouts.guest.guest-layout>
    <div class="border border-gray-800 dark:border-white p-6 min-w-[30vw] rounded-2xl">

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}">
                <img src="https://picsum.photos/id/237/200/300" alt="Logo" class="w-14 h-14 rounded-full">
            </a>
            <flux:separator vertical class="mx-4" />
            <div>
                <flux:heading level="1" size="lg">Create an account</flux:heading>
                <flux:subheading>Join us today!</flux:subheading>
            </div>
        </div>

        <flux:separator horizontal class="mb-4" />

        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST" autocomplete="off">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Full Name with icon -->
                <flux:input type="text" label="Full Name" name="name" :value="old('name')" required
                    placeholder="Enter your full name" icon="user" />

                <!-- Email Address with icon -->
                <flux:input type="email" label="Email Address" name="email" :value="old('email')" required
                    placeholder="Enter your email" icon="envelope" />
                <flux:error name="email" icon="exclamation-circle" class="text-red-500" />

                <!-- Password with max 20 characters + live counter + icon -->
                <flux:field x-data="{ count: 0 }">
                    <div class="flex justify-between mb-3">
                        <flux:label>Password</flux:label>
                        <span class="text-sm text-gray-500 ml-auto" x-text="`${count}/20`"></span>
                    </div>
                    <flux:input type="password" name="password" viewable required maxlength="20"
                        placeholder="Enter your password" icon="key" @input="count = $event.target.value.length" />
                    <flux:error name="password" icon="exclamation-circle" class="text-red-500" />
                </flux:field>

                <!-- Confirm Password with icon -->
                <flux:input type="password" label="Confirm Password" name="password_confirmation" viewable required
                    maxlength="20" placeholder="Confirm your password" icon="key" />

                <!-- Submit Button -->
                <div class="col-span-1 md:col-span-2">
                    <flux:button type="submit" variant="primary" class="w-full cursor-pointer"
                        icon:trailing="user-plus">
                        Register
                    </flux:button>
                </div>

            </div>
        </form>

        @if (Route::has('register'))
            <div class="text-center text-sm mt-4">
                <flux:separator text="OR" class="my-6" />
                <flux:text>
                    Already have an account?
                    <a href="{{ route('login') }}" class="underline">Login</a>
                </flux:text>
            </div>
        @endif
    </div>
    </x-layouts.guest>