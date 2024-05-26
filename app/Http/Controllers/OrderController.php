<?php

namespace App\Http\Controllers;

use App\Http\Requests\FulfillOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Unit;
use Illuminate\Http\Request;
use Punksolid\Wialon\Unit as WialonUnit;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all()->pluck('wialon_nm', 'id');

        return view('orders.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $unit = Unit::find($request->unit_id);

        $fuelAllowedLitres = $unit->fuel_consumed_litres - $unit->fuel_replenished_litres;

        if($fuelAllowedLitres < 1) {
            return back()->withErrors(['unit_id' => 'The allowed litres for this unit is less than 1 litre.'])->withInput();
        }

        $order = $request->user()->orders()->create([
            'unit_id' => $request->unit_id,
            'driver' => $request->driver,
            'fuel_allowed_litres' => $fuelAllowedLitres,
            'mileage_km' => $unit->mileage_km,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Close the specified resource.
     */
    public function close(Order $order)
    {
        return view('orders.close', compact('order'));
    }

    /**
     * Fulfill the specified resource.
     */
    public function fulfill(Order $order, FulfillOrderRequest $request)
    {
        if($order->status === 'closed') {
            return back()->with('error', 'This order has already been fulfilled.');
        }

        if($request->fuel_replenished_litres > $order->fuel_allowed_litres) {
            return back()->withErrors(['fuel_replenished_litres' => 'The fuel replenished litres cannot exceed the allowed amount.'])->withInput();
        }

        $order->update([
            'status' => 'closed',
            'fuel_replenished_litres' => $request->fuel_replenished_litres,
        ]);

        $order->unit->update([
            'fuel_replenished_litres' => $order->unit->fuel_replenished_litres + $request->fuel_replenished_litres,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order fulfilled successfully!');
    }
}
