<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->unit);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'wialon_mileage_sensor_id' => ['required'],
            'wialon_mileage_sensor_calibration_factor' => ['required', 'numeric', 'min:0.001', 'max:1'],
            'wialon_fuel_consumption_sensor_id' => ['required'],
            'wialon_fuel_consumption_sensor_calibration_factor' => ['required', 'numeric', 'min:0.01', 'max:1'],
        ];
    }
}
