<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();

        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        Gate::authorize('update', $unit);

        return view('units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());

        return redirect()->route('units.show', $unit)->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        Gate::authorize('delete', $unit);

        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
