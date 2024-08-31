@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Fuel Dips</h2>
    @can('create', \App\Models\FuelDip::class)
        <a href="{{ route('dips.create') }}" class="btn btn-primary">Add Fuel Dip</a>
    @endcan
</div>
@endsection

@section('content')
    @include('dips._datatable')
@endsection


