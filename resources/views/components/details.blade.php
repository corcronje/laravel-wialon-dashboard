@props(['items' => []])

@if (count($items) > 0)
    <dl class="row">
        @foreach ($items as $label => $value)
            <dt class="col-12 col-md-4 text-md-end">{{ $label }}</dt>
            <dd class="col-12 col-md-8">{{ $value }}</dd>
        @endforeach
    </dl>
@endif
