<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Driver;
use App\Models\Pump;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Unit;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $pump = Pump::where('guid', $request->pump)->first();

        if(!$pump) {
            return response()->json([
                'message' => 'Pump not found'
            ], 404);
        }

        $driver = Driver::find($request->driver_id);

        if(!$driver) {
            return response()->json([
                'message' => 'Driver not found'
            ], 404);
        }

        $unit = Unit::find($request->unit_id);

        if(!$unit) {
            return response()->json([
                'message' => 'Unit not found'
            ], 404);
        }

        $volumeInMillilitres = $request->volume_in_millilitres;

        if($request->transaction_type_id === TransactionType::FUEL_DISPENSED)
        {
            $volumeInMillilitres = 0 - $volumeInMillilitres;
        }

        Transaction::create([
            'transaction_type_id' => $request->transaction_type_id,
            'description' => $request->description,
            'volume_in_millilitres' => $volumeInMillilitres,
            'amount_in_cents' => $request->amount_in_cents,
            'meta' => [],
            'user_id' => 1,
            'driver_id' => $driver->id,
            'tank_id' => $pump->tank->id,
            'pump_id' => $pump->id,
            'unit_id' => $unit->id
        ]);

        return response()->json([
            'message' => 'Transaction created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }
}
