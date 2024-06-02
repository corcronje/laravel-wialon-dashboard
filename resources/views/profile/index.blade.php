@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">My Profile</h2>
    </div>
@endsection

@section('content')
    <form action="{{ route('profile.update', $user) }}" method="post">
        @csrf
        @method('put')
        <x-text-input name="name" title="Name" :value="old('name', $user->name ?? '')" placeholder="Name" />
        <x-email-input name="email" title="Email" :value="old('email', $user->email ?? '')" placeholder="Email" />
        <x-password-input name="password" title="Password" placeholder="Password" />
        <x-password-input name="password_confirmation" title="Confirm Password" :value="old('name', $user->name ?? '')" placeholder="Confirm password" />
        <hr>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
