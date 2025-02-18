@props(['id', 'name', 'label', 'value' => 1, 'checked' => false, 'hiddenValue' => 0])

@php
    $checked = old($name, $checked) ? 'checked' : '';
@endphp

<div class="form-check mb-3">
    <!-- Checkbox Input -->
    <input type="checkbox" id="{{ $id ?? $name }}" name="{{ $name }}" value="{{ $value }}"
        {{ $checked }}
        {{ $attributes->merge(['class' => 'form-check-input' . ($errors->has($name) ? ' is-invalid' : '')]) }}>

    <!-- Label -->
    @if ($label ?? null)
        <label class="form-check-label" for="{{ $id ?? $name }}">
            {{ $label }}
        </label>
    @endif

    <!-- Error Message -->
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
