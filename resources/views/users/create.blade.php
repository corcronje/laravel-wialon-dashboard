@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add User</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        @include('users.form')
        <button type="submit" class="btn btn-primary">Add User</button>
        <a href="{{ route('users.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
