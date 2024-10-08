<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Volume Litres</th>
            <th>Current Litres</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tanks as $tank)
            <tr>
                <td>{{ $tank->name }}</td>
                <td>{{ number_format($tank->volume_in_litres, 2) }}</td>
                <td>{{ number_format($tank->current_volume_in_litres, 2) }}</td>
                <td>
                    @can('view', $tank)
                        <a href="{{ route('tanks.show', $tank) }}" class="btn btn-sm btn-link">View</a>
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
