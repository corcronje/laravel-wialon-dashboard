@extends('layouts.app')

@section('content')
<h1>Viewing order #{{ $order->id }}</h1>
<dl>
    <dt>Unit</dt>
    <dd>{{ $order->unit->wialon_nm }}</dd>
    <dt>Fuel Allowed</dt>
    <dd>{{ $order->fuel_allowed_litres }} Litres</dd>
    <dt>Order Date</dt>
    <dd>{{ $order->created_at->toDateTimeString() }}</dd>
    <dt>Order Status</dt>
    <dd>{{ $order->status }}</dd>
</dl>
<div>
    @can('update', $order)
        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary">Edit</a>
    @endcan
    @can('delete', $order)
        <form action="{{ route('orders.destroy', $order) }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
    <a href="{{ route('orders.index') }}" class="btn btn-link">Back</a>
</div>
@endsection
