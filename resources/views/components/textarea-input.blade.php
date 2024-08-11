@props(['name', 'title', 'value' => '', 'placeholder' => ''])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <textarea name="{{ $name }}" type="text" class="form-control" id="{{ $name }}" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
