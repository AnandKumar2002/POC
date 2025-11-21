<x-layouts.guest.guest-layout>
    <div class="border border-zinc-800 dark:border-white p-6 min-w-[30vw] rounded-2xl">

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}">
                <img src="https://picsum.photos/id/237/200/300" alt="Logo" class="w-14 h-14 rounded-full">
            </a>
            <flux:separator vertical class="mx-4" />
            <div>
                <flux:heading level="1" size="lg">Login to your account</flux:heading>
                <flux:subheading>Welcome back!</flux:subheading>
            </div>
        </div>

        <flux:separator horizontal class="mb-4" />

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="space-y-6">
                <flux:input type="email" label="Email" name="email" :value="old('email')"
                    placeholder="Enter your email" icon="envelope" required />
                <div class="flex justify-between mb-3">
                    <flux:label>Password</flux:label>
                    <a href="{{ route('password.request') }}" class="text-sm">Forgot Password?</a>
                </div>
                <flux:input type="password" name="password" viewable placeholder="Enter your password" icon="key"
                    required />
                <flux:error name="password" icon="exclamation-circle" class="text-red-500" />

                <flux:button type="submit" variant="primary" class="w-full cursor-pointer" icon:trailing="arrow-right">
                    Login
                </flux:button>

            </div>
        </form>

        @if (Route::has('register'))
            <flux:separator text="OR" class="my-6" />
            <div class="text-center text-sm">
                <a href="{{ route('register') }}">Sign up for a new account</a>
            </div>
        @endif
    </div>
</x-layouts.guest.guest-layout>
