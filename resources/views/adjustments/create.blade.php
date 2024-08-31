@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Add Adjustment</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('adjustments.store') }}" method="post">
        @csrf
        @include('adjustments.form')
        <hr>
        <button type="submit" class="btn btn-primary">Add Adjustment</button>
        <a href="{{ route('adjustments.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection
