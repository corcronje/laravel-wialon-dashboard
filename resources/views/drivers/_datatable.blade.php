<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Employee Nr</th>
            <th>Name</th>
            <th>ID Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($drivers as $driver)
            <tr>
                <td>{{ $driver->employee_number }}</td>
                <td>{{ $driver->fullname }}</td>
                <td>{{ substr($driver->said_number, 0, 6) }}...</td>
                <td>
                    @can('view', $driver)
                        <a href="{{ route('drivers.show', $driver) }}" class="btn btn-sm btn-link">View</a>
                    @endcan
                    @can('create', [App\Models\Order::class, new App\Models\Unit(), $driver])
                        <a href="{{ route('orders.create', [
                            'driver_id' => $driver->id,
                        ]) }}"
                            class="btn btn-sm btn-link">New Order</a>
                    @endcan
                    @can('create', [App\Models\Trip::class, new App\Models\Unit(), $driver])
                        <a href="{{ route('trips.create', [
                            'driver_id' => $driver->id,
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#datatable', @json($config ?? []));
    </script>
@endpush
