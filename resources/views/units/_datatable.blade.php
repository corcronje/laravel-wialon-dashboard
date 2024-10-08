<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Distance Km</th>
            <th>Consumption Litres</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($units as $unit)
            <tr>
                <td>{{ $unit->wialon_nm }}</td>
                <td>{{ number_format($unit->distance_travelled_km) }}</td>
                <td>{{ number_format($unit->fuel_allowed_litres) }}</td>
                <td>
                    @can('view', $unit)
                        <a href="{{ route('units.show', $unit) }}" class="btn btn-sm btn-link">View</a>
                    @endcan
                    @can('create', [App\Models\Order::class, $unit, new App\Models\Driver()])
                        <a href="{{ route('orders.create', [
                            'unit_id' => $unit->id,
                        ]) }}"
                            class="btn btn-sm btn-link">New Order</a>
                    @endcan
                    @can('create', [App\Models\Trip::class, $unit, new App\Models\Driver()])
                        <a href="{{ route('trips.create', [
                            'unit_id' => $unit->id,
                        ]) }}"
                            class="btn btn-sm btn-link">New Trip</a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#datatable', @json($config ?? []));
    </script>
@endpush
