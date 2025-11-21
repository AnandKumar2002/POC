<flux:sidebar collapsible sticky stashable
    class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700 w-64">
    <flux:sidebar.header>
        <flux:sidebar.brand logo="https://fluxui.dev/img/demo/logo.png" name="{{ config('app.name') }}"
            class="dark:hidden" />
        <flux:sidebar.brand logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="{{ config('app.name') }}"
            class="hidden dark:flex" />
        <flux:sidebar.collapse />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" :current="Route::is('dashboard')">Dashboard</flux:sidebar.item>
        @can('viewAny', \App\Models\User::class)
        <flux:sidebar.item icon="users" :current="Route::is('users.*')">Users</flux:sidebar.item>
        @endcan
        <flux:sidebar.item icon="home" :current="Route::is('categories')">Category</flux:sidebar.item>
        <flux:sidebar.group expandable heading="Favorites">
            <flux:sidebar.item>Marketing site</flux:sidebar.item>
            <flux:sidebar.item>Android app</flux:sidebar.item>
            <flux:sidebar.item>Brand guidelines</flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

    <flux:spacer />

    <flux:sidebar.nav>
        <flux:sidebar.item icon="information-circle">Help</flux:sidebar.item>
    </flux:sidebar.nav>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name="{{ auth()->user()->name }}" />
        <flux:menu>
            <flux:menu.radio.group>
                <flux:menu.radio checked>{{ auth()->user()->name }}</flux:menu.radio>
                <flux:menu.radio>Details</flux:menu.radio>
            </flux:menu.radio.group>
            <flux:menu.separator />
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:button type="submit" icon="arrow-right-start-on-rectangle" class="w-full"> Logout </flux:button>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>