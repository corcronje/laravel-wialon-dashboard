@props(['name', 'title', 'placeholder' => ''])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <input name="{{ $name }}" type="password" class="form-control" id="{{ $name }}" placeholder="{{ $placeholder }}">
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
