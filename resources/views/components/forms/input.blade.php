@props([
    'type' => 'text',
    'name',
    'id' => null,
    'label' => null,
    'value' => '',
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="block text-xs font-medium text-gray-700 mb-1">
            {{ $label }}
            @if ($attributes->has('required'))
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'border border-gray-300 focus:border-none rounded-md shadow-sm w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1']) }} />

    @error($name)
        <ul class="text-sm text-red-600 mt-1">
            <li>{{ $message }}</li>
        </ul>
    @enderror
</div>
