<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelAdjustment\StoreFuelAdjustmentRequest;
use App\Models\FuelAdjustment;
use App\Models\Tank;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FuelAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', FuelAdjustment::class);

        $adjustments = FuelAdjustment::latest()->get();

        return view('adjustments.index', compact('adjustments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', FuelAdjustment::class);

        $tanks = Tank::all()->pluck('name', 'id');

        return view('adjustments.create', compact('tanks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuelAdjustmentRequest $request)
    {
        $request->user()->adjustments()->create($request->validated());

        return redirect()->route('adjustments.index')->with('success', 'Fuel adjustment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelAdjustment $adjustment)
    {
        Gate::authorize('view', $adjustment);

        return view('adjustments.show', compact('adjustment'));
    }
}
