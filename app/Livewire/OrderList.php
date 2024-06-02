<?php

namespace App\Livewire;

use App\Models\Driver;
use App\Models\Order;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $driver;
    public $unit;
    public $startDate;
    public $endDate;

    public function mount($driver = null, $unit = null)
    {
        $this->driver = $driver;
        $this->unit = $unit;
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        $orders = Order::query()
            ->when($this->driver, fn ($query, $driver) => $query->where('driver_id', $driver->id))
            ->when($this->unit, fn ($query, $unit) => $query->where('unit_id', $unit->id))
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->where('status', 'closed')
            ->latest()
            ->get();

        return view('livewire.order-list', compact('orders'));
    }
}
