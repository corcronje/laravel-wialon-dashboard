@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $transaction->id }}</h2>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Transaction details</h3>
                </div>
                <div class="card-body">
                    <x-details :items="$transaction->toArray()" />
                </div>
            </div>
        </div>
    </div>
@endsection
