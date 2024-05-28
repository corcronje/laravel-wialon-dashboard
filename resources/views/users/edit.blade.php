@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h1 class="m-0">Edit User</h1>
</div>
@endsection

@section('content')
    <form action="{{ route('users.update', $user) }}" method="post">
        @csrf
        @method('put')
        @include('users.form')
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
