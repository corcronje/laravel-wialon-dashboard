@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Orders</h2>
    @can('create', \App\Models\Order::class)
        <a href="{{ route('orders.create') }}" class="btn btn-primary">New Order</a>
    @endcan
</div>
@endsection

@section('content')
    @include('orders._datatable')
@endsection


