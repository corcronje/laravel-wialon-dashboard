<div class="row">
    <div class="col-md-6">
        <x-select-input name="unit_id" title="Unit" :value="old('unit_id', $unit_id ?? 0)" :options="$units"
            placeholder="Select a unit" />
    </div>
    <div class="col-md-6">
        <x-select-input name="driver_id" title="Driver" :value="old('driver_id', $driver_id ?? 0)" :options="$drivers"
            placeholder="Select a driver" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <x-date-input name="start_date" title="Start Date" :value="old('start_date', $start_date ?? now()->format('Y-m-d'))" />
    </div>
    <div class="col-md-6">
        <x-date-input name="end_date" title="End Date" :value="old('end_date', $end_date ?? now()->format('Y-m-d'))" />
    </div>
</div>
