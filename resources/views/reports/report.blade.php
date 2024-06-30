@foreach ($trips->pluck('driver_id')->unique() as $driver)
    <h5 class="mt-5">{{ $trips->where('driver_id', $driver)->first()->driver->employee_number }} - {{ $trips->where('driver_id', $driver)->first()->driver->name }}</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Unit</th>
                <th>Distance</th>
                <th>Cunsumption</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trips->where('driver_id', $driver) as $trip)
                <tr>
                    <td>{{ $trip->created_at }}</td>
                    <td>{{ $trip->unit->wialon_nm }}</td>
                    <td>{{ $trip->distance_travelled_km }}</td>
                    <td>{{ $trip->fuel_consumed_litres }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right">Total:</td>
                <td style="font-weight: 800">{{ $trips->where('driver_id', $driver)->sum('distance_travelled_km') }}</td>
                <td style="font-weight: 800">{{ $trips->where('driver_id', $driver)->sum('fuel_consumed_litres') }}</td>
            </tr>
        </tbody>
    </table>
@endforeach
