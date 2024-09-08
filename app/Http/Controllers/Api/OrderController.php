<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Pump;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        if($request->has('driver')) {
            $orders = Order::where('driver_id', $request->driver)->pending()->get();
            return OrderResource::collection($orders);
        }

        return OrderResource::collection(Order::pending()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }
}
