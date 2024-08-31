@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Fuel Adjustments</h2>
    @can('create', \App\Models\FuelAdjustment::class)
        <a href="{{ route('adjustments.create') }}" class="btn btn-primary">Add Fuel Adjustment</a>
    @endcan
</div>
@endsection

@section('content')
    @include('adjustments._datatable')
@endsection


