@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Attendant</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('attendants.store') }}" method="post">
        @csrf
        @include('attendants.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Attendant</button>
        <a href="{{ route('attendants.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
