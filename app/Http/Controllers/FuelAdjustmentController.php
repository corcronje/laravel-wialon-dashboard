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
        try {
            // start a database transaction
            DB::beginTransaction();

            // create a new fuel adjustment
            $adjustment = $request->user()->adjustments()->create($request->validated());

            // check if the fuel adjustment was created successfully
            if(!$adjustment) {
                throw new \Exception('Failed to create fuel adjustment');
            }

            // create a new transaction
            $transaction = $adjustment->tank->transactions()->create([
                'transaction_type_id' => TransactionType::FUEL_ADJUSTMENT,
                'description' => 'Fuel Adjustment - #' . $adjustment->id,
                'user_id' => $adjustment->user_id,
                'volume_in_millilitres' => $adjustment->volume_in_millilitres,
            ]);

            // check if the transaction was created successfully
            if(!$transaction) {
                throw new \Exception('Failed to create transaction');
            }

            // commit the database transaction
            DB::commit();

            return redirect()->route('adjustments.index')->with('success', 'Fuel adjustment created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', 'Failed to create fuel adjustment');
        }
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
