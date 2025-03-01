@props(['name', 'label', 'value' => '', 'rows' => 4, 'placeholder' => '', 'error' => ''])

<textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
    class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
