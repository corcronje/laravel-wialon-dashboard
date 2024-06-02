@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Fuel Consumption Per Unit</h2>
    </div>
@endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Driver</th>
                <th>Unit</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Distance</th>
                <th>Volume</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->created_at->toDateString() }}</td>
                    <td>{{ $order->driver->name }}</td>
                    <td>{{ $order->unit->wialon_nm }}</td>
                    <td>{{ $order->distance_travelled_km }}</td>
                    <td>{{ $order->fuel_allowed_litres }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
