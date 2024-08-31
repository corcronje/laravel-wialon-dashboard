@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Drop</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('drops.store') }}" method="post">
        @csrf
        @include('drops.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Drop</button>
        <a href="{{ route('drops.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
