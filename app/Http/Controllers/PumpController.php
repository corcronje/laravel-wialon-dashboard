<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePumpRequest;
use App\Http\Requests\UpdatePumpRequest;
use App\Models\Pump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        return view('pumps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePumpRequest $request)
    {
        Pump::create($request->validated());

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

        return view('pumps.edit', compact('pump'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePumpRequest $request, Pump $pump)
    {
        $pump->update($request->validated());

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
