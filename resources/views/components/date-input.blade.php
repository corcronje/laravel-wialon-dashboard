@props(['name', 'title', 'value' => '', 'placeholder' => ''])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <input name="{{ $name }}" type="date" class="form-control" id="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
