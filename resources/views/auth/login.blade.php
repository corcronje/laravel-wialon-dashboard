@extends('layouts.app')
@section('content')
    <h2>Login</h2>
    <p>Enter your email and password below to login</p>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <x-email-input name="email" title="Email address" placeholder="Your email address" :value="old('email')" />
        <x-password-input name="password" title="Password" placeholder="Your password" />
        <button type="submit" class="btn btn-primary">Continue</button>
        <a href="{{ route('password.request') }}" class="btn btn-link">Reset my password</a>
    </form>
@endsection
