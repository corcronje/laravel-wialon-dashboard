@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Viewing Driver</h2>
</div>
@endsection

@section('content')
<dl>
    <dt>Employee Number</dt>
    <dd>{{ $driver->employee_number }}</dd>
    <dt>Name</dt>
    <dd>{{ $driver->name }}</dd>
</dl>
<div>
    @can('update', $driver)
        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-primary">Edit</a>
    @endcan
    @can('delete', $driver)
        <form action="{{ route('drivers.destroy', $driver) }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
    <a href="{{ route('drivers.index') }}" class="btn btn-link">Back</a>
</div>
@endsection
