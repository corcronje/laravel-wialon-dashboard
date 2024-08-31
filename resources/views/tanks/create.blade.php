@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Pump</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('pumps.store') }}" method="post">
        @csrf
        @include('pumps.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Pump</button>
        <a href="{{ route('pumps.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
