<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Volume</th>
            <th>Current Litres</th>
            <th>Cents Per Litre</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tanks as $tank)
            <tr>
                <td>{{ $tank->name }}</td>
                <td>{{ $tank->description }}</td>
                <td>{{ $tank->volume_litres }}</td>
                <td>{{ $tank->current_litres }}</td>
                <td>{{ $tank->cents_per_litre }}</td>
                <td>{{ $tank->status === 'active' ? 'Active' : 'Inactive' }}</td>
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
