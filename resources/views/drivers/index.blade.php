@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Drivers</h2>
    @can('create', \App\Models\Driver::class)
        <a href="{{ route('drivers.create') }}" class="btn btn-primary">Add Driver</a>
    @endcan
</div>
@endsection

@section('content')
    @include('drivers._datatable')
@endsection


