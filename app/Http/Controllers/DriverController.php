<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Driver::class);

        $drivers = Driver::all();

        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Driver::class);

        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        Driver::create($request->validated());

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        Gate::authorize('view', $driver);

        return view('drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        Gate::authorize('update', $driver);

        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        Gate::authorize('update', $driver);

        $driver->update($request->validated());

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        Gate::authorize('delete', $driver);

        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $driver = Driver::withTrashed()->findOrFail($id);

        Gate::authorize('restore', $driver);

        $driver->restore();

        return redirect()->route('drivers.index')->with('success', 'Driver restored successfully!');
    }
}
