@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">New Trip</h2>
    </div>
@endsection

@section('content')
    <form action="{{ route('trips.store') }}" method="post">
        @csrf
        @include('trips.form')
        <hr>
        <button type="submit" class="btn btn-primary">Create Trip</button>
        <a href="{{ route('trips.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
