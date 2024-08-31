@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Fuel Drops</h2>
    @can('create', \App\Models\FuelDrop::class)
        <a href="{{ route('drops.create') }}" class="btn btn-primary">Add Fuel Drop</a>
    @endcan
</div>
@endsection

@section('content')
    @include('drops._datatable')
@endsection


