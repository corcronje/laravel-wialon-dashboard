@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">Dashboard</h2>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h4>Recent Orders</h4>
        @can('create', [App\Models\Order::class, new App\Models\Unit(), new App\Models\Driver()])
            <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">New Order</a>
        @endcan
    </div>
    @include('orders._datatable', [
        'config' => [
            'order' => [0, 'asc'],
            'searching' => false,
            'paging' => false,
            'info' => false,
            'ordering' => false,
        ],
    ])
    <div class="d-flex justify-content-between align-items-center mt-5">
        <h4>Recent Trips</h4>
        @can('create', [App\Models\Trip::class, new App\Models\Unit(), new App\Models\Driver()])
            <a href="{{ route('trips.create') }}" class="btn btn-sm btn-primary">New Trip</a>
        @endcan
    </div>
    @include('trips._datatable', [
        'config' => [
            'order' => [0, 'asc'],
            'searching' => false,
            'paging' => false,
            'info' => false,
            'ordering' => false,
        ],
    ])
@endsection
