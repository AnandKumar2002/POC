@props([
    'name',
    'text' => 'Open',
    'variant' => 'primary',
    'icon' => null,
])

<flux:modal.trigger name="{{ $name }}">
    <flux:button variant="{{ $variant }}" icon="{{ $icon }}">
        {{ $text }}
    </flux:button>
</flux:modal.trigger>
