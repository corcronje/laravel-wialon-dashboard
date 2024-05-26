@props(['name', 'title', 'value' => 0, 'placeholder' => 'Select...', 'options' => []])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select">
        <option {{ $value === 0 ? 'selected' : '' }} disabled>{{ $placeholder }}</option>
        @foreach ($options as $id => $title)
            <option value="{{ $id }}" {{ $value == $id ? 'selected' : '' }}>{{ $title }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
