<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Unit</th>
            <th>Driver</th>
            <th>Kilometers</th>
            <th>Litres</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trips as $trip)
            <tr>
                <td>{{ $trip->created_at->toDateTimeString() }}</td>
                <td>{{ $trip->unit->wialon_nm }}</td>
                <td>{{ $trip->driver->name }}</td>
                <td>{{ number_format($trip->distance_travelled_km) }}</td>
                <td>{{ number_format($trip->fuel_replenished_litres) }}</td>
                @if ($trip->status === 'pending')
                    <td><span class="badge bg-warning">Pending</span></td>
                @else
                    <td><span class="badge bg-success">Closed</span></td>
                @endif
                <td>
                    @can('view', $trip)
                        <a href="{{ route('trips.show', $trip) }}" class="btn btn-sm btn-link">View</a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
    @if ($showTotals ?? false)
        <tfoot>
            <tr>
                <th colspan="3">Totals</th>
                <th>{{ number_format($trips->sum('distance_travelled_km')) }}</th>
                <th>{{ number_format($trips->sum('fuel_replenished_litres')) }}</th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    @endif
</table>

@push('styles')
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
