@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $adjustment->tank->name }}</h2>
        @can('update', $adjustment)
            <a href="{{ route('adjustments.edit', $adjustment) }}" title="Edit" class="btn btn-sm btn-primary">Edit</a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Adjustment details</h3>
                </div>
                <div class="card-body">
                    <x-details :items="$adjustment->toArray()" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="deleteAdjustmentModal" tabindex="-1" aria-labelledby="deleteAdjustmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAdjustmentModalLabel">Delete Adjustment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-adjustment-form" action="{{ route('adjustments.destroy', $adjustment) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <span>Are you sure you want to delete this adjustment?</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-adjustment-form" class="btn btn-danger">Yes, delete this adjustment</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush
