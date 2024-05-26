@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h1 class="m-0">Dashboard</h1>
        @can('create', \App\Models\Order::class)
            <a href="{{ route('orders.create') }}" class="btn btn-primary">New Order</a>
        @endcan
    </div>
@endsection

@section('content')
    @include('orders._datatable', [
        'config' => [
            'order' => [0, 'desc'],
            'searching' => false,
            'paging' => false,
            'info' => false,
            'ordering' => false,
        ],
    ])
@endsection
