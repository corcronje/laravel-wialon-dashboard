@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">New Trip</h2>
    </div>
@endsection

@section('content')
    <form action="{{ route('trips.store') }}" method="post">
        @csrf
        @include('trips.form')
        <hr>
        <button type="submit" class="btn btn-primary">Create Trip</button>
        <a href="{{ route('trips.index') }}" class="btn btn-link">Back</a>
    </form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#driver_id').select2();
        $('#unit_id').select2();
    });
</script>
@endpush
