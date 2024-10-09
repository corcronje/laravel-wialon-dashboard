<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attendant\StoreAttendantRequest;
use App\Http\Requests\Attendant\UpdateAttendantRequest;
use App\Models\Attendant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Attendant::class);

        $attendants = Attendant::all();

        return view('attendants.index', compact('attendants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Attendant::class);

        return view('attendants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendantRequest $request)
    {
        Gate::authorize('create', Attendant::class);

        Attendant::create($request->validated());

        return redirect()->route('attendants.index')->with('success', 'Attendant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendant $attendant)
    {
        Gate::authorize('view', $attendant);

        return view('attendants.show', compact('attendant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendant $attendant)
    {
        Gate::authorize('update', $attendant);

        return view('attendants.edit', compact('attendant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendantRequest $request, Attendant $attendant)
    {
        Gate::authorize('update', $attendant);

        $attendant->update($request->validated());

        return redirect()->route('attendants.index')->with('success', 'Attendant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendant $attendant)
    {
        Gate::authorize('delete', $attendant);

        $attendant->delete();

        return redirect()->route('attendants.index')->with('success', 'Attendant deleted successfully');
    }
}
