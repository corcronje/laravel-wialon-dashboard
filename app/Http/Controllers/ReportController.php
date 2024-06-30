<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Order;
use App\Models\Trip;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $trips = Trip::with('driver', 'unit')->get();

        $units = $trips->pluck('unit.wialon_nm', 'unit.id')->unique();

        $drivers = $trips->pluck('driver.name', 'driver.id')->unique();

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

        $trips = Trip::with('driver', 'unit')->get();

        $units = $trips->pluck('unit.wialon_nm', 'unit.id')->unique();

        $drivers = $trips->pluck('driver.name', 'driver.id')->unique();

        //dd($request->unit_id, $request->driver_id, $request->start_date, $request->end_date);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $trips = Trip::with('unit', 'driver')
            ->when($request->unit_id ?? 0 != 0, function ($query) use ($request) {
                return $query->where('unit_id', $request->unit_id);
            })
            ->when($request->driver_id ?? 0 != 0, function ($query) use ($request) {
                return $query->where('driver_id', $request->driver_id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->closed()
            ->get();

        return view('reports.index', [
            'units' => $units,
            'drivers' => $drivers,
            'driver_id' => $request->driver_id,
            'unit_id' => $request->unit_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'trips' => $trips,
        ]);
    }
}
