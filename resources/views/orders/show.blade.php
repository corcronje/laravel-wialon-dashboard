@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Order Detail</h2>
    </div>
@endsection

@section('content')
    <x-details :items="[
        'Date' => $order->created_at->toDateTimeString(),
        'Unit' => $order->unit->wialon_nm,
        'Driver' => $order->driver->name,
        'Fuel Allowed' => number_format($order->fuel_allowed_litres) . ' Litres',
        'Fuel Replenished' => number_format($order->fuel_replenished_litres) . ' Litres',
        'Distance Travelled' => number_format($order->distance_travelled_km) . ' Km',
        'Status' => $order->status]" />
    <hr>
    <div>
        @can('update', $order)
            <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $order)
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrderModal">Delete</button>
        @endcan
        @can('close', $order)
            <a href="{{ route('orders.close', $order) }}" class="btn btn-success">Close</a>
        @endcan
        <a href="{{ route('orders.index') }}" class="btn btn-link">Back</a>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteOrderModalLabel">Delete Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-order-form" action="{{ route('orders.destroy', $order) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <span>Are you sure you want to delete this order?</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-order-form" class="btn btn-danger">Yes, delete this order</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush
