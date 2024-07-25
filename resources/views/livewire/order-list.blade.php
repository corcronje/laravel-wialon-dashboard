<div>
    <div class="row justify-space-between mb-3">
        <div class="col-6">
            <label for="startDate">From</label>
            <input type="date" wire:model.live="startDate" class="form-control">
        </div>
        <div class="col-6">
            <label for="endDate">To</label>
            <input type="date" wire:model.live="endDate" class="form-control">
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Order</th>
                <th>Liters</th>
                <th>Kilometers</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->created_at->toDateString() }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}">{{ $order->number }}</a>
                    </td>
                    <td>{{ number_format($order->fuel_replenished_litres) }}</td>
                    <td>{{ number_format($order->mileage_km) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
