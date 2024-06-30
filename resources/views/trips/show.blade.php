@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Trip Detail</h2>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h5 class="border-bottom pb-3 mb-3">Trip</h5>
            <x-details :items="[
                'Date' => $trip->created_at->toDateTimeString(),
                'Unit' => $trip->unit->wialon_nm,
                'Driver' => $trip->driver->name,
                'Fuel Consumed' => number_format($trip->fuel_consumed_litres) . ' Litres',
                'Distance Travelled' => number_format($trip->distance_travelled_km) . ' Km',
                'Status' => $trip->status,
            ]" />
        </div>
        <div class="col-md-6">
            <h5 class="border-bottom pb-3 mb-3">Previous Trip</h5>
            @if ($trip->previousTrip)
                <x-details :items="[
                    'Date' => $trip->previousTrip->created_at->toDateTimeString(),
                    'Unit' => $trip->previousTrip->unit->wialon_nm,
                    'Driver' => $trip->previousTrip->driver->name,
                    'Fuel Consumed' => number_format($trip->previousTrip->fuel_consumed_litres) . ' Litres',
                    'Distance Travelled' => number_format($trip->previousTrip->distance_travelled_km) . ' Km',
                    'Status' => $trip->previousTrip->status,
                ]" />
            @else
                <span>No previous trip</span>
            @endif
        </div>
    </div>
    <hr>
    <div>
        @can('update', $trip)
            <a href="{{ route('trips.edit', $trip) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $trip)
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#deleteTripModal">Delete</button>
        @endcan
        @can('close', $trip)
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#closeTripModal">Close</button>
        @endcan
        @can('swap', $trip)
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#swapDriverModal">
                Swap Driver
            </button>
        @endcan
        <a href="{{ route('trips.index') }}" class="btn btn-link">Back</a>
    </div>
@endsection

@push('modals')
    @can('close', $trip)
        <div class="modal fade" id="closeTripModal" tabindex="-1" aria-labelledby="closeTripModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="closeTripModalLabel">Close Trip</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="close-trip-form" action="{{ route('trips.close', $trip) }}" method="post" class="d-inline">
                            @csrf
                            <span>Are you sure you want to close this trip?</span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="close-trip-form" class="btn btn-success">Yes, close this trip</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('swap', $trip)
        <div class="modal fade" id="swapDriverModal" tabindex="-1" aria-labelledby="swapDriverModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="swapDriverModalLabel">Swap Driver</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="swap-driver-form" action="{{ route('trips.swap', $trip) }}" method="post" class="d-inline">
                            @csrf
                            <x-select-input name="driver_id" title="Driver" :value="old('driver_id', $trip->driver_id ?? ($driver->id ?? 0))" :options="$drivers"
                                placeholder="Select a driver" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="swap-driver-form" class="btn btn-success">Swap driver</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('delete', $trip)
        <div class="modal fade" id="deleteTripModal" tabindex="-1" aria-labelledby="deleteTripModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteTripModalLabel">Delete Trip</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="delete-trip-form" action="{{ route('trips.destroy', $trip) }}" method="post"
                            class="d-inline">
                            @csrf
                            @method('delete')
                            <span>Are you sure you want to delete this trip?</span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="delete-trip-form" class="btn btn-danger">Yes, delete this trip</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endpush
