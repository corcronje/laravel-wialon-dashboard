<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseOrderRequest;
use App\Models\Order;

class CloseOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CloseOrderRequest $request)
    {
        $order = Order::findOrFail($request->order_id);

        if($order->fuel_replenished_ml) {
            return back()->with('error', 'The order has already been closed.');
        }

        if($request->fuel_ml > $order->fuel_allowed_ml) {
            return back()->with('error', 'The amount of fuel replenished exceeds the allowed amount.');
        }

        $order->update([
            'order_number' => $request->order_number,
            'fuel_replenished_ml' => $request->fuel_ml,
        ]);

        $order->unit->update([
            'fuel_replenished_ml' => $order->unit->fuel_consumption_ml + $request->fuel_ml,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order closed successfully!');
    }
}
