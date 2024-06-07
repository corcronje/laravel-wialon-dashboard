@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Viewing Unit</h2>
    </div>
@endsection

@section('content')
    <x-details :items="[
        'Wialon Id' => $unit->wialon_id,
        'Wialon Name' => $unit->wialon_nm,
        'Fuel' =>
            number_format($unit->fuel_consumed_litres) .
            ' Litres' .
            ' (' .
            $unit->wialon_fuel_consumption_sensor_id .
            '*' .
            $unit->wialon_fuel_consumption_sensor_calibration_factor .
            ')',
        'Fuel Replenished' => number_format($unit->fuel_replenished_litres) . ' Litres',
        'Fuel Allowed' => number_format($unit->fuel_consumed_litres - $unit->fuel_replenished_litres) . ' Litres',
        'Kilometers' =>
            number_format($unit->mileage_km) .
            ' Km' .
            ' (' .
            $unit->wialon_mileage_sensor_id .
            '*' .
            $unit->wialon_mileage_sensor_calibration_factor .
            ')',
        'Kilometers Replenished' => number_format($unit->mileage_replenished_km) . ' Km',
        'Distance Travelled' => number_format($unit->distance_travelled_km) . ' Km',
        'Fuel Consumption' =>
            number_format($unit->fuel_consumption_litres_per_km, 2) .
            ' Litres/Km' .
            ' (' .
            number_format($unit->fuel_consumption_km_per_litre, 2) .
            ' Km/Litre)',
        'Created' => $unit->created_at,
        'Updated' => $unit->updated_at,
    ]" />
    <hr>
    <div class="d-flex g-3">
        @can('create', App\Models\Order::class)
            <a href="{{ route('orders.create', [
                'unit_id' => $unit->id,
            ]) }}" class="btn btn-primary">New
                Order</a>
        @endcan
        <form action="{{ route('units.reset', $unit) }}" method="post">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-warning">Reset</button>
        </form>
        <a href="{{ route('units.index') }}" class="btn btn-link">Back</a>
    </div>
@endsection
