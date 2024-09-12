<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pump\StorePumpRequest;
use App\Http\Requests\Pump\UpdatePumpRequest;
use App\Models\Pump;
use App\Models\Tank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PumpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Pump::class);

        $pumps = Pump::all();

        return view('pumps.index', compact('pumps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Pump::class);

        $tanks = Tank::all()->pluck('name', 'id');

        return view('pumps.create', compact('tanks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePumpRequest $request)
    {
        Pump::create([
            'tank_id' => $request->tank_id,
            'guid' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'cents_per_millilitre' => $request->cents_per_litre * 100,
            'pulses_per_millilitre' => $request->pulses_per_litre * 1000,
            'status' => 'active',
        ]);

        return redirect()->route('pumps.index')->with('success', 'Pump created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pump $pump)
    {
        Gate::authorize('view', $pump);

        return view('pumps.show', compact('pump'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pump $pump)
    {
        Gate::authorize('update', $pump);

        $tanks = Tank::all()->pluck('name', 'id');

        return view('pumps.edit', compact('pump', 'tanks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePumpRequest $request, Pump $pump)
    {
        $pump->update([
            'tank_id' => $request->tank_id,
            'guid' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'cents_per_millilitre' => $request->cents_per_litre * 100,
            'pulses_per_millilitre' => $request->pulses_per_litre * 1000,
            'status' => 'active',
        ]);

        return redirect()->route('pumps.index')->with('success', 'Pump updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pump $pump)
    {
        Gate::authorize('delete', $pump);

        $pump->delete();

        return redirect()->route('pumps.index')->with('success', 'Pump deleted successfully.');
    }
}
