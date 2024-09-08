<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Pump;
use App\Models\Transaction;
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
        $request->validate([
            'pump' => 'required|exists:pumps,guid',
        ]);

        $pump = Pump::where('guid', $request->pump)->first();

        if(!$pump) {
            return response()->json([
                'message' => 'Pump not found'
            ], 404);
        }

        Transaction::create([
            'transaction_type_id' => $request->transaction_type_id,
            'description' => $request->description,
            'volume_in_millilitres' => $request->volume_in_millilitres,
            'amount_in_cents' => $request->amount_in_cents,
            'meta' => [
                'pump' => $pump
            ],
            'user_id' => 1
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
