<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection = Driver::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('surname', 'like', '%' . $request->search . '%')
                ->orWhere('employee_number', 'like', '%' . $request->search . '%')
                ->orWhere('said_number', 'like', '%' . $request->search . '%');
        })->get();

        return DriverResource::collection($collection);
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
    public function show(Driver $driver)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        // not allowed
        return response()->json([
            'message' => 'Not allowed'
        ], 403);
    }
}
