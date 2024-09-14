<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Pump</th>
            <th>Unit</th>
            <th>Driver</th>
            <th>Litres</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->toDateTimeString() }}</td>
                <td>{{ $transaction->pump?->name ?? '-' }}</td>
                <td>{{ $transaction->unit?->wialon_nm ?? '-' }}</td>
                <td>{{ $transaction->driver?->name ?? '-' }}</td>
                <td>{{ number_format($transaction->volume_in_millilitres / 1000, 2) }}</td>
                <td>
                    @can('view', $transaction)
                        <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-sm btn-link">View</a>
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
