@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Driver</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('drivers.store') }}" method="post">
        @csrf
        @include('drivers.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Driver</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
