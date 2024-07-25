<?php

namespace App\Http\Requests;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $driver = Driver::find($this->driver_id);
        $unit = Unit::find($this->unit_id);
        return $this->user()->can('create', [Trip::class, $unit, $driver]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'driver_id' => 'required|exists:drivers,id',
            'unit_id' => 'required|exists:units,id',
        ];
    }
}
