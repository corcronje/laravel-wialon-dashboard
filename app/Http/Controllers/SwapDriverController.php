<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwapDriverRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class SwapDriverController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SwapDriverRequest $request, Trip $trip)
    {
        // close the trip
        $trip->close();

        // create a new trip
        $newTrip = Trip::create([
            'user_id' => $trip->user_id,
            'driver_id' => $request->driver_id,
            'unit_id' => $trip->unit_id,
            'data' => [
                'note' => 'Driver swapped',
                'previous_trip_id' => $trip->id,
                'start_at' => now(),
                'unit_data_start' => $trip->unit()->get()->first()->toArray(),
            ]
        ]);

        return redirect()->route('trips.show', $newTrip)->with('success', 'Driver swapped successfully.');
    }
}
