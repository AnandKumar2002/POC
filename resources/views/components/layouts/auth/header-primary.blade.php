@props([
    'title' => null, 
    'actions' => [], 
    'onTitleClick' => null,
    'titleHref' => null
])

@php
    $displayTitle = $title ?? config('app.name');
    $clickAction = $onTitleClick ?? '';
@endphp

<flux:header class="bg-zinc-100 dark:bg-zinc-900 flex-row justify-around items-center h-18 px-4 md:mx-auto md:max-w-7xl backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 shrink-0 z-50">
    <flux:navbar class="flex-1">
        {{-- Title Logic --}}
        @if($titleHref)
            <a href="{{ $titleHref }}" wire:navigate class="no-underline">
                <flux:heading size="lg" class="font-bold tracking-tight uppercase transition-all cursor-pointer hover:text-zinc-500">
                    {{ $displayTitle }}
                </flux:heading>
            </a>
        @else
            <flux:heading 
                size="lg" 
                wire:click="{{ $clickAction }}" 
                @class([
                    'font-bold tracking-tight uppercase transition-all',
                    'cursor-pointer hover:text-zinc-500' => $onTitleClick,
                    'cursor-default' => ! $onTitleClick
                ])
            >
                {{ $displayTitle }}
            </flux:heading>
        @endif
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="gap-1">
        @foreach ($actions as $item)
            @if (($item['type'] ?? '') === 'badge')
                @php
                    $badgeColor = $item['badge_color'] ?? 'red';
                    $colorMap = [
                        'red'   => 'bg-red-50 dark:bg-red-950 border-red-200 dark:border-red-900 text-red-600 dark:text-red-400',
                        'green' => 'bg-green-50 dark:bg-green-950 border-green-200 dark:border-green-900 text-green-600 dark:text-green-400',
                        'blue'  => 'bg-blue-50 dark:bg-blue-950 border-blue-200 dark:border-blue-900 text-blue-600 dark:text-blue-400',
                        'zinc'  => 'bg-zinc-100 dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400',
                    ];
                    $currentClasses = $colorMap[$badgeColor] ?? $colorMap['red'];
                    $hasHref = isset($item['href']);
                @endphp

                @if($hasHref)
                    <a href="{{ $item['href'] }}" wire:navigate @class(['flex items-center gap-2 border rounded-full cursor-pointer py-1 pl-1 pr-3 mr-1 no-underline', $currentClasses])>
                        @if (isset($item['image']))
                            <img src="{{ $item['image'] }}" class="size-6 rounded-full border border-zinc-300 dark:border-zinc-700">
                        @elseif(isset($item['icon']))
                            <flux:icon :name="$item['icon']" variant="mini" />
                        @endif
                        <span class="text-[10px] font-bold uppercase tracking-wider">{{ $item['label'] ?? 'Live' }}</span>
                    </a>
                @else
                    <div @if(isset($item['action'])) wire:click="{{ $item['action'] }}" @endif @class(['flex items-center gap-2 border rounded-full cursor-pointer py-1 pl-1 pr-3 mr-1', $currentClasses])>
                        @if (isset($item['image']))
                            <img src="{{ $item['image'] }}" class="size-6 rounded-full border border-zinc-300 dark:border-zinc-700">
                        @elseif(isset($item['icon']))
                            <flux:icon :name="$item['icon']" variant="mini" />
                        @endif
                        <span class="text-[10px] font-bold uppercase tracking-wider">{{ $item['label'] ?? 'Live' }}</span>
                    </div>
                @endif
            @else
                {{-- Standard Button - NO NESTED @IF BLOCKS --}}
                <flux:button 
                    variant="subtle" 
                    size="sm" 
                    :href="$item['href'] ?? null"
                    :wire:click="$item['action'] ?? null"
                    :wire:navigate="isset($item['href'])"
                    class="cursor-pointer"
                >
                    @if (isset($item['image']))
                        <img src="{{ $item['image'] }}" class="size-6 rounded-full border border-zinc-300 dark:border-zinc-700">
                    @elseif(isset($item['icon']))
                        <flux:icon :name="$item['icon']" variant="mini" />
                    @endif
                </flux:button>

                @if($item['separator'] ?? false)
                    <flux:separator vertical variant="subtle" class="h-4 mx-1" />
                @endif
            @endif
        @endforeach
    </flux:navbar>
</flux:header>