<flux:navbar
    class="bg-zinc-100 dark:bg-zinc-900 flex-row justify-around items-center h-full px-4 md:mx-auto md:max-w-3xl">
    <div class="flex items-center justify-center flex-col">
        <flux:navlist.item icon="home" wire:navigate href="/dashboard" label="Home"
            class="flex flex-col items-center justify-center text-xs !w-fit transition-all hover:bg-zinc-100 dark:hover:bg-zinc-800">
        </flux:navlist.item>
        <span class="">
            Home
        </span>
    </div>
    <div class="flex items-center justify-center flex-col">
        <flux:navlist.item icon="puzzle-piece" wire:navigate href="/game" label="game"
            class="flex flex-col items-center justify-center text-xs !w-fit transition-all hover:bg-zinc-100 dark:hover:bg-zinc-800">
        </flux:navlist.item>
        <span class="">
            Game
        </span>
    </div>
    <div class="flex items-center justify-center flex-col">
        <flux:navlist.item icon="user" wire:navigate href="/profile" label="profile"
            class="flex flex-col items-center justify-center text-xs !w-fit transition-all hover:bg-zinc-100 dark:hover:bg-zinc-800">
        </flux:navlist.item>
        <span class="">
            Profile
        </span>
    </div>
</flux:navbar>