@props([
    'type' => 'text',
    'name',
    'id' => null,
    'value' => '',
    'label' => null,
])

<div class="mb-3">
    @if ($label)

        <label for="{{ $id ?? $name }}">
            {{ $label }}
            @if ($attributes->has('star'))
                <span class="text-danger">*</span>
            @endif
        </label>

    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }} />

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
