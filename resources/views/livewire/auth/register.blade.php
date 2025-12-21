<div class="flex min-h-screen" x-data="{ password: '', count: 0, max: 20 }">

    {{-- LEFT: REGISTER --}}
    <div class="flex-[2] flex justify-center items-center">
        <div class="w-80 max-w-80 space-y-6">

            {{-- Logo --}}
            <div class="flex justify-center opacity-50">
                <a href="/" wire:navigate class="group flex items-center gap-3">
                    <svg class="h-4 text-zinc-800 dark:text-white" viewBox="0 0 18 13" fill="none">
                        <line x1="1" y1="5" x2="1" y2="10" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <line x1="5" y1="1" x2="5" y2="8" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <line x1="9" y1="5" x2="9" y2="10" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <line x1="13" y1="1" x2="13" y2="12" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <line x1="17" y1="5" x2="17" y2="10" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>

                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            <flux:heading class="text-center" size="xl">
                Create your account
            </flux:heading>

            {{-- OAuth (UI only for now) --}}
            {{-- <div class="space-y-4">
                <flux:button class="w-full">
                    <x-slot name="icon">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23.06 12.25C23.06 11.47 22.99 10.72 22.86 10H12.5V14.26H18.42C18.16 15.63 17.38 16.79 16.21 17.57V20.34H19.78C21.86 18.42 23.06 15.6 23.06 12.25Z"
                                fill="#4285F4" />
                            <path
                                d="M12.4997 23C15.4697 23 17.9597 22.02 19.7797 20.34L16.2097 17.57C15.2297 18.23 13.9797 18.63 12.4997 18.63C9.63969 18.63 7.20969 16.7 6.33969 14.1H2.67969V16.94C4.48969 20.53 8.19969 23 12.4997 23Z"
                                fill="#34A853" />
                            <path
                                d="M6.34 14.0899C6.12 13.4299 5.99 12.7299 5.99 11.9999C5.99 11.2699 6.12 10.5699 6.34 9.90995V7.06995H2.68C1.93 8.54995 1.5 10.2199 1.5 11.9999C1.5 13.7799 1.93 15.4499 2.68 16.9299L5.53 14.7099L6.34 14.0899Z"
                                fill="#FBBC05" />
                            <path
                                d="M12.4997 5.38C14.1197 5.38 15.5597 5.94 16.7097 7.02L19.8597 3.87C17.9497 2.09 15.4697 1 12.4997 1C8.19969 1 4.48969 3.47 2.67969 7.07L6.33969 9.91C7.20969 7.31 9.63969 5.38 12.4997 5.38Z"
                                fill="#EA4335" />
                        </svg>
                    </x-slot>
                    Continue with Google
                </flux:button>
            </div>

            <flux:separator text="or" /> --}}

            {{-- FORM --}}
            <form wire:submit.prevent="register" class="flex flex-col gap-6">

                <flux:input label="Full name" placeholder="Your name" icon="user" wire:model.defer="name" />

                <flux:input label="Email" type="email" placeholder="email@example.com" icon="envelope"
                    wire:model.defer="email" />

                {{-- Password field with Alpine --}}
                <flux:field>
                    <div class="flex justify-between mb-1">
                        <flux:label>Password</flux:label>
                        <span class="text-sm text-gray-400" x-text="count + '/' + max"></span>
                    </div>
                    <flux:input type="password" placeholder="Minimum 8 characters" icon="key" viewable
                        x-model="password" wire:model.defer="password"
                        @input="count = password.length; if(password.length > max) password = password.slice(0, max)" />
                    <flux:error name="password" />
                </flux:field>

                <flux:input type="password" label="Confirm password" placeholder="Re-enter password" icon="key" viewable
                    wire:model.defer="password_confirmation" />

                <flux:checkbox wire:model="terms" label="I agree to the terms & privacy policy" />

                <flux:button variant="primary" class="w-full cursor-pointer" type="submit" icon:trailing="arrow-right"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Create account</span>
                    <span wire:loading>Creating…</span>
                </flux:button>
            </form>

            <flux:subheading class="text-center">
                Already have an account?
                <flux:link href="{{ route('login') }}" wire:navigate>
                    Log in
                </flux:link>
            </flux:subheading>

        </div>
    </div>

    {{-- RIGHT: MARKETING --}}
    <div class="flex-[3] relative max-lg:hidden overflow-hidden p-4">
        <img src="{{ asset('images/auth/auth-aurora.png') }}" alt="Auth background"
            class="absolute inset-0 w-full h-full object-cover" />
        <div class="relative z-10 text-white h-full flex flex-col justify-end p-16 bg-black/30">
            <div class="flex gap-2 mb-4">
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
            </div>
            <div class="mb-6 italic text-3xl xl:text-4xl">
                Great products come from clarity, not complexity.
            </div>
            <div class="flex gap-4 items-center">
                <flux:avatar src="{{ asset('images/auth/auth-aurora.png') }}" size="xl" />
                <div>
                    <div class="text-lg font-medium">Anand Kumar</div>
                    <div class="text-zinc-300">Web Developer</div>
                </div>
            </div>
        </div>
    </div>
</div>