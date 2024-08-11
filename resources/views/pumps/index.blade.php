@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Pumps</h2>
    @can('create', \App\Models\Pump::class)
        <a href="{{ route('pumps.create') }}" class="btn btn-primary">Add Pump</a>
    @endcan
</div>
@endsection

@section('content')
    @include('pumps._datatable')
@endsection


