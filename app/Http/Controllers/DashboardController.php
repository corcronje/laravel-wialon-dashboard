<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $orders = Order::pending()->latest()->take(5)->get();

        $trips = Trip::pending()->latest()->take(5)->get();

        return view('dashboard.index', compact('orders', 'trips'));
    }
}
