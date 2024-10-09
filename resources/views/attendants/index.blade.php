@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Attendants</h2>
    @can('create', \App\Models\Attendant::class)
        <a href="{{ route('attendants.create') }}" class="btn btn-primary">Add Attendant</a>
    @endcan
</div>
@endsection

@section('content')
    @include('attendants._datatable')
@endsection


