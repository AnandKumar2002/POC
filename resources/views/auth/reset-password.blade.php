<x-layouts.guest.guest-layout>
    <div class="border border-gray-800 dark:border-white p-6 min-w-[30vw] rounded-2xl">

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}">
                <img src="https://picsum.photos/id/237/200/300" alt="Logo" class="w-14 h-14 rounded-full">
            </a>
            <flux:separator vertical class="mx-4" />
            <div>
                <flux:heading level="1" size="lg">Reset Password</flux:heading>
                <flux:subheading>Set your new password!</flux:subheading>
            </div>
        </div>

        <flux:separator horizontal class="mb-4" />

        <!-- Reset Password Form -->
        <form action="{{ route('password.store') }}" method="post">
            @csrf
            <div class="space-y-6">
                <input type="hidden" value="{{ $token }}" name="token">

                <flux:input type="email" label="Email" name="email" value="{{ $email }}" readonly icon="envelope" />

                <flux:field x-data="{ count: 0 }">
                    <div class="flex justify-between mb-3">
                        <flux:label>New Password</flux:label>
                        <span class="text-sm text-gray-500 ml-auto" x-text="`${count}/20`"></span>
                    </div>
                    <flux:input type="password" name="password" viewable required maxlength="20"
                        placeholder="Enter your password" icon="key" @input="count = $event.target.value.length" />
                    <flux:error name="password" icon="exclamation-circle" class="text-red-500" />
                </flux:field>

                <!-- Confirm Password with icon -->
                <flux:input type="password" label="Confirm Password" name="password_confirmation" viewable required
                    maxlength="20" placeholder="Confirm your password" icon="key" />

                <flux:button type="submit" variant="primary" class="w-full cursor-pointer" icon:trailing="arrow-right">
                    Reset Password
                </flux:button>
            </div>
        </form>
    </div>
    </x-layouts.guest>