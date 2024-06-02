@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Driver</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('drivers.update', $driver) }}" method="post">
        @csrf
        @method('put')
        @include('drivers.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Driver</button>
        <a href="{{ route('drivers.show', $driver) }}" class="btn btn-link">Back</a>
    </form>
@endsection
