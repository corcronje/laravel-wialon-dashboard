@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Pump</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('pumps.update', $pump) }}" method="post">
        @csrf
        @method('put')
        @include('pumps.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Pump</button>
        <a href="{{ route('pumps.show', $pump) }}" class="btn btn-link">Back</a>
    </form>
@endsection
