@props(['name', 'id' => null, 'value' => '', 'label' => null])

<div class="mb-3">
    @if ($label)

        <label for="{{ $id ?? $name }}">
            {{ $label }}
            @if ($attributes->has('star'))
                <span class="text-danger">*</span>
            @endif
        </label>

    @endif

    <select name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>
        {{ $slot }}
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
