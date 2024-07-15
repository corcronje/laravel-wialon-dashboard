<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResetUnitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Unit $unit)
    {
        Gate::authorize('reset', $unit);

        $unit->update([
            'fuel_replenished_litres' => $unit->fuel_consumed_litres,
            'mileage_replenished_km' => $unit->mileage_km,
            'reset_at' => now(),
            'reset_by' => auth()->id(),
        ]);

        return back()->with('success', 'Unit reset successfully.');
    }
}
