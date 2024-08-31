@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Tank</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('tanks.store') }}" method="post">
        @csrf
        @include('tanks.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Tank</button>
        <a href="{{ route('tanks.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
