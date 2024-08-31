@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Tanks</h2>
    @can('create', \App\Models\Tank::class)
        <a href="{{ route('tanks.create') }}" class="btn btn-primary">Add Tank</a>
    @endcan
</div>
@endsection

@section('content')
    @include('tanks._datatable')
@endsection


