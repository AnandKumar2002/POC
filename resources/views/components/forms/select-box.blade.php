@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => '',
    'required' => false,
    'errorMessages' => [],
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="block text-xs font-medium text-gray-700 mb-1">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <select id="{{ $id ?? $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => ' focus:border-none rounded-md shadow-sm w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1']) }}>
        {{ $slot }}
    </select>
    @if ($errorMessages)
        <ul class="text-sm text-red-600 ms-1 mt-1">
            @foreach ((array) $errorMessages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>