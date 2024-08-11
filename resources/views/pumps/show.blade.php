@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $pump->name }}</h2>
        @can('update', $pump)
            <a href="{{ route('pumps.edit', $pump) }}" title="Edit" class="btn btn-sm btn-primary">Edit</a>
        @endcan
        {{-- @can('delete', $pump)
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePumpModal">
                Delete
            </button>
        @endcan
        <a href="{{ route('pumps.index') }}" class="btn btn-linkg">Back</a> --}}
    </div>
@endsection



{{-- @section('content')
    @livewire('order-list', ['pump' => $pump], key($pump->id))
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Pump details</h3>
                </div>
                <div class="card-body">
                    <x-details :items="$pump->toArray()" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="deletePumpModal" tabindex="-1" aria-labelledby="deletePumpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePumpModalLabel">Delete pump</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-pump-form" action="{{ route('pumps.destroy', $pump) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <span>Are you sure you want to delete this pump?</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-pump-form" class="btn btn-danger">Yes, delete this pump</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush
