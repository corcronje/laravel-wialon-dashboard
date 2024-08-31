@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Transaction</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('transactions.update', $transaction) }}" method="post">
        @csrf
        @method('put')
        @include('transactions.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Transaction</button>
        <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-link">Back</a>
    </form>
@endsection
