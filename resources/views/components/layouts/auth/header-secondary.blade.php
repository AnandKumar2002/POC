@props(['title' => '', 'actions' => [], 'backHref' => null])

<flux:header
    class="bg-zinc-100 dark:bg-zinc-900 flex-row justify-around items-center h-full px-4 md:mx-auto md:max-w-7xl">
    {{-- Start: Back Button --}}
    <div class="flex items-center">
        @if ($backHref)
            <flux:button wire:navigate href="{{ $backHref }}" variant="subtle" icon="chevron-left" inset="left" />
        @endif
    </div>

    {{-- Center: Title --}}
    <div class="absolute left-1/2 -translate-x-1/2">
        <flux:heading size="lg" class="font-semibold text-zinc-800 dark:text-white">
            {{ $title }}
        </flux:heading>
    </div>

    <flux:spacer />

    {{-- End: Actions Loop --}}
    <div class="flex items-center gap-1">
        @foreach ($actions as $item)
            <flux:button variant="subtle" size="sm" icon="{{ $item['icon'] }}" wire:navigate
                wire:click="{{ $item['action'] ?? '' }}"
                class="{{ ($item['color'] ?? '') === 'danger' ? 'text-red-500' : '' }}" />
        @endforeach
    </div>
</flux:header>