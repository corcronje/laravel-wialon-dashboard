@extends('layouts.app')

@section('content')
    <h2>New Order</h2>
    <p>Use the form below to create a new order</p>
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        @include('orders.form')
        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
