@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $adjustment->tank->name }}</h2>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Adjustment details</h3>
                </div>
                <div class="card-body">
                    <x-details :items="$adjustment->toArray()" />
                </div>
            </div>
        </div>
    </div>
@endsection
