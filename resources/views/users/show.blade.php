@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h1 class="m-0">Viewing User</h1>
</div>
@endsection

@section('content')
<dl>
    <dt>Name</dt>
    <dd>{{ $user->name }}</dd>
    <dt>Email</dt>
    <dd>{{ $user->email }}</dd>
    <dt>Role</dt>
    <dd>{{ $user->role->name }}</dd>
</dl>
<div>
    @can('update', $user)
        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
    @endcan
    @can('delete', $user)
        <form action="{{ route('users.destroy', $user) }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
    <a href="{{ route('users.index') }}" class="btn btn-link">Back</a>
</div>
@endsection
