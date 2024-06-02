<?php

namespace App\Http\Controllers;

use App\Http\Requests\FulfillOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
    public function create(Request $request)
    {
        Gate::authorize('create', Order::class);

        $units = Unit::all()->pluck('wialon_nm', 'id');

        $drivers = Driver::all()->pluck('name', 'id');

        $unit = $request->unit_id ? Unit::find($request->unit_id) : null;

        $driver = $request->driver_id ? Driver::find($request->driver_id) : null;

        return view('orders.create', compact('units', 'unit', 'drivers', 'driver'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $unit = Unit::find($request->unit_id);

        if($unit->fuel_allowed_litres < 1) {
            return back()->withErrors(['unit_id' => 'The allowed litres for this unit is less than 1 litre.'])->withInput();
        }

        $order = $request->user()->orders()->create([
            'unit_id' => $request->unit_id,
            'driver_id' => $request->driver_id,
            'fuel_consumed_litres' => $unit->fuel_consumed_litres,
            'fuel_allowed_litres' => $unit->fuel_allowed_litres,
            'mileage_km' => $unit->mileage_km,
            'distance_travelled_km' => $unit->distance_travelled_km,
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
        Gate::authorize('update', $order);

        $units = Unit::all()->pluck('wialon_nm', 'id');

        $drivers = Driver::all()->pluck('name', 'id');

        return view('orders.edit', compact('order', 'units', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $unit = Unit::find($request->unit_id);

        if($unit->fuel_allowed_litres < 1) {
            return back()->withErrors(['unit_id' => 'The allowed litres for this unit is less than 1 litre.'])->withInput();
        }

        $order->update([
            'unit_id' => $request->unit_id,
            'driver_id' => $request->driver_id,
            'fuel_consumed_litres' => $unit->fuel_consumed_litres,
            'fuel_allowed_litres' => $unit->fuel_allowed_litres,
            'mileage_km' => $unit->mileage_km,
            'distance_travelled_km' => $unit->distance_travelled_km,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete', $order);

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
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
            'order_number' => $request->order_number,
            'status' => 'closed',
            'fuel_replenished_litres' => $request->fuel_replenished_litres,
        ]);

        $order->unit->update([
            'fuel_replenished_litres' => $order->unit->fuel_replenished_litres + $request->fuel_replenished_litres,
            'mileage_replenished_km' => $order->unit->mileage_km,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order fulfilled successfully!');
    }
}
