@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $drop->tank->name }}</h2>
        @can('update', $drop)
            <a href="{{ route('drops.edit', $drop) }}" title="Edit" class="btn btn-sm btn-primary">Edit</a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Drop details</h3>
                </div>
                <div class="card-body">
                    <x-details :items="$drop->toArray()" />
                </div>
            </div>
        </div>
    </div>
@endsection
