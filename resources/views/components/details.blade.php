@props(['items' => []])

@if (count($items) > 0)
    <dl class="row">
        @foreach ($items as $label => $value)
            @php
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
            @endphp
            <dt class="col-12 col-md-4 col-lg-3 text-md-end">{{ $label }}</dt>
            <dd class="col-12 col-md-8 col-lg-9">{{ $value }}</dd>
        @endforeach
    </dl>
@endif
