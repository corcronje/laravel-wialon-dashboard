@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Transaction</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('transactions.store') }}" method="post">
        @csrf
        @include('transactions.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
