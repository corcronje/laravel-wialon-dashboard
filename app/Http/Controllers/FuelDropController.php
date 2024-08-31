<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuelDropRequest;
use App\Http\Requests\UpdateFuelDropRequest;
use App\Models\FuelDrop;
use App\Models\Tank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FuelDropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', FuelDrop::class);

        $drops = FuelDrop::latest()->get();

        return view('drops.index', compact('drops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', FuelDrop::class);

        $tanks = Tank::all()->pluck('name', 'id');

        return view('drops.create', compact('tanks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuelDropRequest $request)
    {
        $request->user()->drops()->create($request->validated());

        return redirect()->route('drops.index')->with('success', 'Fuel drop created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelDrop $drop)
    {
        Gate::authorize('view', $drop);

        return view('drops.show', compact('drop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelDrop $drop)
    {
        Gate::authorize('update', $drop);

        $tanks = Tank::all()->pluck('name', 'id');

        return view('drops.edit', compact('drop', 'tanks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelDropRequest $request, FuelDrop $drop)
    {
        $drop->update($request->validated());

        return redirect()->route('drops.index')->with('success', 'Fuel drop updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelDrop $drop)
    {
        Gate::authorize('delete', $drop);

        $drop->delete();

        return redirect()->route('drops.index')->with('success', 'Fuel drop deleted successfully');
    }
}
