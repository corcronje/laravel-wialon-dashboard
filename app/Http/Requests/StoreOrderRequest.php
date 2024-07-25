<?php

namespace App\Http\Requests;

use App\Models\Driver;
use App\Models\Order;
use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $unit = Unit::find($this->unit_id);
        $driver= Driver::find($this->driver_id);

        if($this->user()->can('create', [Order::class, $unit, $driver])) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_id' => 'required|exists:units,id',
            'driver_id' => 'required|exists:drivers,id',
        ];
    }
}
