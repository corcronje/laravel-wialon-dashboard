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
        $driver = new Driver();

        if($request->has('driver_id')) {
            $driver = Driver::findOrFail($request->driver_id);
        }

        $unit = new Unit();

        if($request->has('unit_id')) {
            $unit = Unit::findOrFail($request->unit_id);
        }

        Gate::authorize('create', [Trip::class, $unit, $driver]);

        $drivers = Driver::available()->get();

        if ($drivers->isEmpty()) {
            return redirect()->route('trips.index')->with('error', 'All drivers are currently on shifts.');
        }

        $units = Unit::available()->get();

        if ($units->isEmpty()) {
            return redirect()->route('trips.index')->with('error', 'All units are currently on shifts.');
        }

        return view('trips.create', [
            'units' => $units->pluck('wialon_nm', 'id'),
            'drivers' => $drivers->pluck('employee_number_and_name', 'id'),
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

        return redirect()->route('trips.show', $trip)->with('success', 'Shift created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        Gate::authorize('view', $trip);

        $drivers = Driver::available()->get()->pluck('employee_number_and_name', 'id');

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

        return redirect()->route('trips.index')->with('success', 'Shift deleted successfully.');
    }
}
