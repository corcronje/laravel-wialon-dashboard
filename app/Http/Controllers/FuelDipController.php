<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuelDipRequest;
use App\Http\Requests\UpdateFuelDipRequest;
use App\Models\FuelDip;
use App\Models\Tank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FuelDipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', FuelDip::class);

        $dips = FuelDip::latest()->get();

        return view('dips.index', compact('dips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', FuelDip::class);

        $tanks = Tank::all()->pluck('name', 'id');

        return view('dips.create', compact('tanks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuelDipRequest $request)
    {
        $request->user()->dips()->create([
            'volume_in_millilitres' => $request->volume_in_litres * 1000,
            'tank_id' => $request->tank_id,
        ]);

        return redirect()->route('dips.index')->with('success', 'Fuel dip created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelDip $dip)
    {
        Gate::authorize('view', $dip);

        return view('dips.show', compact('dip'));
    }
}
