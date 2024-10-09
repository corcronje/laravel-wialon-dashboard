@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $attendant->employee_number }} - {{ $attendant->name }}</h2>
         @can('update', $attendant)
            <a href="{{ route('attendants.edit', $attendant) }}" title="Edit" class="btn btn-sm btn-primary">Edit</a>
        @endcan
    </div>
@endsection

@section('content')
    @livewire('order-list', ['attendant' => $attendant], key($attendant->id))
@endsection

@push('modals')
    <div class="modal fade" id="deleteAttendantModal" tabindex="-1" aria-labelledby="deleteAttendantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAttendantModalLabel">Delete Attendant</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-attendant-form" action="{{ route('attendants.destroy', $attendant) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <span>Are you sure you want to delete this attendant?</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-attendant-form" class="btn btn-danger">Yes, delete this attendant</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush
