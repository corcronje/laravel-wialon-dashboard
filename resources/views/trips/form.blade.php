<x-select-input name="unit_id" title="Vehicle" :value="old('unit_id', $trip->unit_id ?? $unit->id ?? 0)" :options="$units" placeholder="Select a vehicle" />
<x-select-input name="driver_id" title="Driver" :value="old('driver_id', $trip->driver_id ?? $driver->id ?? 0)" :options="$drivers" placeholder="Select a driver" />
