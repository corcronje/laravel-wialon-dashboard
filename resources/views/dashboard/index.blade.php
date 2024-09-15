@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">Dashboard</h2>
    </div>
@endsection

@section('content')
    <div class="row">
        @foreach ($tanks as $tank)
            <div class="col-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <x-tank.level :tank="$tank" />

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('tanks.show', $tank) }}" class="btn btn-link w-100">
                            {{ $tank->name }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
