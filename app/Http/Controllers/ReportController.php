<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Order;
use App\Models\Unit;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $units = $this->units();

        $drivers = $this->drivers();

        $start_date = now()->startOf('month')->format('Y-m-d');

        $end_date = now()->endOf('month')->format('Y-m-d');

        return view('reports.index', compact('units', 'drivers', 'start_date', 'end_date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'unit_id' => 'nullable',
            'driver_id' => 'nullable',
        ]);

        $orders = Order::with('unit', 'driver')
            ->when($request->unit_id != 0, function ($query) use ($request) {
                return $query->where('unit_id', $request->unit_id);
            })
            ->when($request->driver_id != 0, function ($query) use ($request) {
                return $query->where('driver_id', $request->driver_id);
            })
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();

        return view('reports.index', [
            'units' => $this->units(),
            'drivers' => $this->drivers(),
            'driver_id' => $request->driver_id,
            'unit_id' => $request->unit_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'orders' => $orders,
        ]);
    }

    private function drivers()
    {
        return Order::with('driver')->get()->pluck('driver.name', 'driver.id')->unique();
    }

    private function units()
    {
        return Order::with('unit')->get()->pluck('unit.wialon_nm', 'unit.id')->unique();
    }
}
