@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Update Order</h2>
    </div>
@endsection

@section('content')
    <form action="{{ route('orders.update', $order) }}" method="post">
        @csrf
        @method('put')
        @include('orders.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
