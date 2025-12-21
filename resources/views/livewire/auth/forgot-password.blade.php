<div class="flex min-h-screen">

    {{-- LEFT: FORGOT PASSWORD --}}
    <div class="flex-[2] flex justify-center items-center">
        <div class="w-80 max-w-80 space-y-6">

            {{-- Logo --}}
            <div class="flex justify-center opacity-50">
                <a href="/" wire:navigate class="group flex items-center gap-3">
                    <svg class="h-4 text-zinc-800 dark:text-white" viewBox="0 0 18 13" fill="none">
                        <line x1="1" y1="5" x2="1" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <line x1="5" y1="1" x2="5" y2="8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <line x1="9" y1="5" x2="9" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <line x1="13" y1="1" x2="13" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <line x1="17" y1="5" x2="17" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>

                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">
                        Logo
                    </span>
                </a>
            </div>

            <flux:heading class="text-center" size="xl">
                Forgot your password?
            </flux:heading>

            <flux:subheading class="text-center">
                Enter your email and we’ll send you a reset link.
            </flux:subheading>

            {{-- FORM --}}
            <form wire:submit.prevent="sendResetLink" class="flex flex-col gap-6">

                <flux:input
                    label="Email"
                    type="email"
                    placeholder="email@example.com"
                    icon="envelope"
                    wire:model.defer="email"
                />

                <flux:button
                    variant="primary"
                    class="w-full cursor-pointer"
                    type="submit"
                    icon:trailing="arrow-right"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Send reset link</span>
                    <span wire:loading>Sending…</span>
                </flux:button>
            </form>

            <flux:subheading class="text-center">
                Remember your password?
                <flux:link href="{{ route('login') }}" wire:navigate>
                    Log in
                </flux:link>
            </flux:subheading>

        </div>
    </div>

    {{-- RIGHT: MARKETING (UNCHANGED) --}}
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
