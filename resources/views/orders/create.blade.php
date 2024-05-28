@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">New Order</h2>
    </div>
@endsection

@section('content')
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        @include('orders.form')
        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
