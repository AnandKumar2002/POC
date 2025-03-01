@props([
    'type' => 'button',
    'size' => 'md',
    'variant' => 'primary',
    'disabled' => false,
    'icon' => null,
    'class' => '',
])

@php
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-5 py-3 text-lg',
    ];

    $variants = [
        'primary' => 'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-300',
        'secondary' => 'bg-gray-500 text-white hover:bg-gray-600 focus:ring-gray-300',
        'danger' => 'bg-red-500 text-white hover:bg-red-600 focus:ring-red-300',
        'success' => 'bg-green-500 text-white hover:bg-green-600 focus:ring-green-300',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-300',
        'transparent'=>'bg-transparent text-black shadow-none focus:ring-0'
    ];

    $buttonClasses =
        $sizes[$size] .
        ' ' .
        ($variants[$variant] ?? $variants['primary']) .
        ' inline-flex items-center justify-center rounded shadow focus:outline-none focus:ring-2 focus:ring-opacity-50 ' .
        ($disabled ? 'opacity-50 cursor-not-allowed' : '') .
        ' ' .
        $class;
@endphp

<button type="{{ $type }}" class="{{ $buttonClasses }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes }}>
    @if ($icon)
        <span class="mr-2">
            <i class="{{ $icon }}"></i>
        </span>
    @endif

    {{ $slot }}
</button>