<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseTripRequest;
use App\Models\Trip;

class CloseTripController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CloseTripRequest $request, Trip $trip)
    {
        $trip->close();

        return redirect()->route('trips.index')->with('success', 'Trip closed successfully.');
    }
}
