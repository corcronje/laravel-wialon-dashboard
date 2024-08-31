@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Drop</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('drops.update', $drop) }}" method="post">
        @csrf
        @method('put')
        @include('drops.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Drop</button>
        <a href="{{ route('drops.show', $drop) }}" class="btn btn-link">Back</a>
    </form>
@endsection
