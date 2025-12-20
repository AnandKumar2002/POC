<flux:sidebar collapsible sticky stashable
    class="bg-zinc-100 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700 w-64">
    <flux:sidebar.header>
        <flux:sidebar.brand logo="https://fluxui.dev/img/demo/logo.png" name="{{ config('app.name') }}"
            class="dark:hidden" />
        <flux:sidebar.brand logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="{{ config('app.name') }}"
            class="hidden dark:flex" />
        <flux:sidebar.collapse />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" wire:navigate :href="route('dashboard')" :current="Route::is('dashboard')">
            Dashboard
        </flux:sidebar.item>
        <flux:sidebar.item icon="home" :current="Route::is('categories')">Category</flux:sidebar.item>
        <flux:sidebar.group expandable heading="Favorites" :expanded="false">
            <flux:sidebar.item>Marketing site</flux:sidebar.item>
            <flux:sidebar.item>Android app</flux:sidebar.item>
            <flux:sidebar.item>Brand guidelines</flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

    <flux:spacer />

    <flux:sidebar.nav>
        <flux:sidebar.item icon="cog">Settings</flux:sidebar.item>
        <flux:sidebar.item icon="information-circle">Help</flux:sidebar.item>
    </flux:sidebar.nav>
</flux:sidebar>