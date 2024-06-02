@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $driver->employee_number }} - {{ $driver->name }}</h2>
         @can('update', $driver)
            <a href="{{ route('drivers.edit', $driver) }}" title="Edit" class="btn btn-sm btn-primary">Edit</a>
        @endcan
    </div>
@endsection

@section('content')
    @livewire('order-list', ['driver' => $driver], key($driver->id))
@endsection

@push('modals')
    <div class="modal fade" id="deleteDriverModal" tabindex="-1" aria-labelledby="deleteDriverModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteDriverModalLabel">Delete Driver</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-driver-form" action="{{ route('drivers.destroy', $driver) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <span>Are you sure you want to delete this driver?</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-driver-form" class="btn btn-danger">Yes, delete this driver</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush
