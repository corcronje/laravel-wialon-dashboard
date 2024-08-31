@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Fuel Transactions</h2>
    @can('create', \App\Models\FuelTransaction::class)
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add Fuel Transaction</a>
    @endcan
</div>
@endsection

@section('content')
    @include('transactions._datatable')
@endsection


