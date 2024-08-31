@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Dip</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('dips.update', $dip) }}" method="post">
        @csrf
        @method('put')
        @include('dips.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Dip</button>
        <a href="{{ route('dips.show', $dip) }}" class="btn btn-link">Back</a>
    </form>
@endsection
