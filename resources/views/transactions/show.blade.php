@extends('layouts.app')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <h2 class="m-0">{{ $transaction->pump->name }}</h2>
        @can('update', $transaction)
            <a href="{{ route('transactions.edit', $transaction) }}" title="Edit" class="btn btn-sm btn-primary">Edit</a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Transaction details</h3>
                </div>
                <div class="card-body">
                    <x-details :items="$transaction->toArray()" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="deleteTransactionModal" tabindex="-1" aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteTransactionModalLabel">Delete Transaction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-transaction-form" action="{{ route('transactions.destroy', $transaction) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <span>Are you sure you want to delete this transaction?</span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-transaction-form" class="btn btn-danger">Yes, delete this transaction</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush
