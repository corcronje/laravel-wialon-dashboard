<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PumpResource;
use App\Models\Pump;
use Illuminate\Http\Request;

class PumpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PumpResource::collection(Pump::all());
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
    public function show(Request $request, $pump)
    {
        $pump = Pump::where('guid', $request->pump)->firstOrFail();

        return PumpResource::make($pump);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pump $pump)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pump $pump)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }
}
