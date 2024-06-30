<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::get();
        return view('trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Trip::class);

        $drivers = Driver::withoutPendingTrips()->get();

        if ($drivers->isEmpty()) {
            return redirect()->route('trips.index')->with('error', 'All drivers are currently on trips.');
        }

        $units = Unit::withoutPendingTrips()->get();

        if ($units->isEmpty()) {
            return redirect()->route('trips.index')->with('error', 'All units are currently on trips.');
        }

        return view('trips.create', [
            'units' => $units->pluck('wialon_nm', 'id'),
            'drivers' => $drivers->pluck('name', 'id'),
            'driver_id' => $request->driver_id ?? null,
            'unit_id' => $request->unit_id ?? null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $unit = Unit::findOrFail($request->unit_id);

        $data = [
            'note' => $request->note ?? null,
            'start_at' => now(),
            'unit_data_start' => $unit->toArray(),
        ];

        $trip = Trip::create([
            'user_id' => auth()->id(),
            'driver_id' => $request->driver_id,
            'unit_id' => $request->unit_id,
            'data' => $data,
        ]);

        return redirect()->route('trips.show', $trip)->with('success', 'Trip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        Gate::authorize('view', $trip);

        $drivers = Driver::withoutPendingTrips()->get()->pluck('name', 'id');

        return view('trips.show', compact('trip', 'drivers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        Gate::authorize('delete', $trip);

        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }
}
