@extends('layouts.app')

@section('content')
    <h2>Close Order</h2>
    <p>Use the form below to create a new order</p>
    <form action="{{ route('orders.close', $order) }}" method="post">
        @csrf
        <x-text-input name="order_number" title="Order Number" :value="old('order_number')" placeholder="Order Number" />
        <x-text-input name="fuel_replenished_litres" title="Fuel" :value="old('fuel_replenished_litres')" placeholder="Fuel" />
        <button type="submit" class="btn btn-primary">Close Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
