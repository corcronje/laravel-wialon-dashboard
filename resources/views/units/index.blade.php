@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Units</h2>
    @can('import', \App\Models\Unit::class)
        <a href="{{ route('units.index') }}" class="btn btn-primary">Sync</a>
    @endcan
</div>
@endsection

@section('content')
    @include('units._datatable', ['config' => ['order' => [[1, 'des']]]])
@endsection
