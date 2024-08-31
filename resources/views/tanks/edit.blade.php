@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit tank</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('tanks.update', $tank) }}" method="post">
        @csrf
        @method('put')
        @include('tanks.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update tank</button>
        <a href="{{ route('tanks.show', $tank) }}" class="btn btn-link">Back</a>
    </form>
@endsection
