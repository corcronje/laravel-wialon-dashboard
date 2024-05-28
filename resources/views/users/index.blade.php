@extends('layouts.app')

@section('page-title')
<div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
    <h2 class="m-0">Users</h2>
    @can('create', \App\Models\User::class)
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    @endcan
</div>
@endsection

@section('content')
    @include('users._datatable')
@endsection


