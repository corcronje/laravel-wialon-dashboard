@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Trips</h2>
    @can('create', [App\Models\Trip::class, new App\Models\Unit(), new App\Models\Driver()])
        <a href="{{ route('trips.create') }}" class="btn btn-primary">Add Trip</a>
    @endcan
</div>
@endsection

@section('content')
    @include('trips._datatable', ['config' => ['order' => [[0, 'desc']]]])
@endsection


