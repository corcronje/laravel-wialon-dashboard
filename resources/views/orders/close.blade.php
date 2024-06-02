@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Close Order</h2>
    </div>
@endsection

@section('content')
    <form action="{{ route('orders.close', $order) }}" method="post">
        @csrf
        <x-details :items="[
            'Date' => $order->created_at->toDateTimeString(),
            'Unit' => $order->unit->wialon_nm,
            'Driver' => $order->driver->name,
            'Fuel Allowed' => number_format($order->fuel_allowed_litres) . ' Litres',
            'Distance Travelled' => number_format($order->distance_travelled_km) . ' Km',
        ]" />
        <hr>
        <x-text-input name="order_number" title="Order Number" :value="old('order_number')" placeholder="Order Number" />
        <x-text-input name="fuel_replenished_litres" title="Fuel Replenished" :value="old('fuel_replenished_litres')" placeholder="Fuel Replenished (Litres)" />
        <hr>
        <button type="submit" class="btn btn-primary">Close Order</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-link">Back</a>
    </form>
@endsection
