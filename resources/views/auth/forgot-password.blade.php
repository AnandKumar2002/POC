<x-layouts.guest.guest-layout>
    <div class="border border-gray-800 dark:border-white p-6 min-w-[30vw] rounded-2xl">

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}">
                <img src="https://picsum.photos/id/237/200/300" alt="Logo" class="w-14 h-14 rounded-full">
            </a>
            <flux:separator vertical class="mx-4" />
            <div>
                <flux:heading level="1" size="lg">Forgot Password?</flux:heading>
                <flux:subheading>We got you covered!</flux:subheading>
            </div>
        </div>

        <flux:separator horizontal class="mb-4" />

        <!-- Forgot Password Form -->
        <form action="" method="post">
            @csrf
            <div class="space-y-6">
                <flux:input type="email" label="Email" name="email" placeholder="Enter your email" icon="envelope"
                    required />

                <flux:button type="submit" variant="primary" class="w-full cursor-pointer" icon:trailing="arrow-right">
                    Send Email
                </flux:button>
            </div>
        </form>

        <div class="text-center text-sm mt-4">
            <flux:separator text="OR" class="my-6" />
            <flux:text>Back to
                <a href="{{ route('login') }}" class="underline">
                    Login
                </a>
            </flux:text>
        </div>
    </div>
    </x-layouts.guest>