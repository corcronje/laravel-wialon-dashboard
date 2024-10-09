@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Attendant</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('attendants.update', $attendant) }}" method="post">
        @csrf
        @method('put')
        @include('attendants.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Attendant</button>
        <a href="{{ route('attendants.show', $attendant) }}" class="btn btn-link">Back</a>
    </form>
@endsection
