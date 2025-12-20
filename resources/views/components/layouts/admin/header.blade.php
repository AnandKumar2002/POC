<flux:header class="bg-zinc-100 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:spacer />
    <flux:navbar class="mr-4">
        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
            aria-label="Toggle dark mode" class="mx-2 cursor-pointer" />
        <flux:navbar.item square icon="magnifying-glass" href="#" label="Search" />
    </flux:navbar>
    <flux:dropdown position="top" align="start">
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
        <flux:menu>
            <flux:menu.item href="#" wire:navigate icon="user">{{ auth()?->user()?->name ?? 'Guest' }}</flux:menu.item>
            <flux:menu.separator />
            <form method="POST" action="#">
                @csrf
                <flux:button type="submit" icon="arrow-right-start-on-rectangle" class="w-full"> Logout </flux:button>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>