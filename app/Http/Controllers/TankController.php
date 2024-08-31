<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTankRequest;
use App\Http\Requests\UpdateTankRequest;
use App\Models\Tank;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanks = Tank::all();

        return view('tanks.index', compact('tanks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Tank::class);

        return view('tanks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTankRequest $request)
    {
        Tank::create($request->validated());

        return redirect()->route('tanks.index')->with('success', 'Tank created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tank $tank)
    {
        Gate::authorize('view', $tank);

        return view('tanks.show', compact('tank'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tank $tank)
    {
        Gate::authorize('update', $tank);

        return view('tanks.edit', compact('tank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTankRequest $request, Tank $tank)
    {
        $tank->update($request->validated());

        return redirect()->route('tanks.show', $tank)->with('success', 'Tank updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tank $tank)
    {
        Gate::authorize('delete', $tank);

        $tank->delete();

        return redirect()->route('tanks.index')->with('success', 'Tank deleted successfully.');
    }
}
