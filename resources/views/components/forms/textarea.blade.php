@props(['name', 'id' => null, 'value' => '', 'label' => null, 'rows' => 3])

<div class="mb-3">
    @if ($label)

        <label for="{{ $id ?? $name }}">
            {{ $label }}
            @if ($attributes->has('star'))
                <span class="text-danger">*</span>
            @endif
        </label>

    @endif
    <textarea name="{{ $name }}" id="{{ $id ?? $name }}" rows="{{ $rows }}" value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>

    </textarea>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
