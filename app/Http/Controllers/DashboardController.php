<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tank;
use App\Models\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $tanks = Tank::orderBy('name')->get();

        return view('dashboard.index', compact('tanks'));
    }
}
