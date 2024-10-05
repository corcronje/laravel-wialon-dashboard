@extends('layouts.app')

@section('page-title')
    <div class="pb-3 mb-3 border-bottom">
        <h2 class="m-0">Viewing Unit</h2>
    </div>
@endsection

@section('content')
    <form id="edit-unit-form" action="{{ route('units.update', $unit) }}" method="post">
        @csrf
        @method('PUT')
        <x-text-input name="tag_id" title="Tag Number" :value="old('tag_id', $unit->tag_id ?? '')" placeholder="Tag Number" />
        <x-text-input name="wialon_mileage_sensor_id" title="Mileage Sensor Parameter" :value="old('wialon_mileage_sensor_id', $unit->wialon_mileage_sensor_id ?? '')" placeholder="io_87" />
        <x-text-input name="wialon_mileage_sensor_calibration_factor" title="Mileage Calibration Factor" :value="old(
            'wialon_mileage_sensor_calibration_factor',
            $unit->wialon_mileage_sensor_calibration_factor ?? '',
        )"
            placeholder="0.001" />
        <x-text-input name="wialon_fuel_consumption_sensor_id" title="Fuel Consumption Sensor Parameter" :value="old('wialon_fuel_consumption_sensor_id', $unit->wialon_fuel_consumption_sensor_id ?? '')"
            placeholder="io_83" />
        <x-text-input name="wialon_fuel_consumption_sensor_calibration_factor" title="Fuel Consumption Calibration Factor"
            :value="old(
                'wialon_fuel_consumption_sensor_calibration_factor',
                $unit->wialon_fuel_consumption_sensor_calibration_factor ?? '',
            )" placeholder="0.1" />
    </form>
    <hr>
    <div class="d-flex gap-2">
        <button type="submit" form="edit-unit-form" class="btn btn-primary">Save</button>
        <a href="{{ route('units.show', $unit) }}" class="btn btn-link">Cancel</a>
    </div>
@endsection
