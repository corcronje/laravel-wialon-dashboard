@extends('layouts.app')

@section('page-title')
<div class="pb-3 mb-3 border-bottom">
    <h2 class="m-0">Edit Adjustment</h2>
</div>
@endsection

@section('content')
    <form action="{{ route('adjustments.update', $adjustment) }}" method="post">
        @csrf
        @method('put')
        @include('adjustments.form')
        <hr>
        <button type="submit" class="btn btn-primary">Update Adjustment</button>
        <a href="{{ route('adjustments.show', $adjustment) }}" class="btn btn-link">Back</a>
    </form>
@endsection
