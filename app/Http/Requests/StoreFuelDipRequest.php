<?php

namespace App\Http\Requests;

use App\Models\FuelDip;
use Illuminate\Foundation\Http\FormRequest;

class StoreFuelDipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', FuelDip::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tank_id' => ['required', 'integer', 'exists:tanks,id'],
            'volume_in_litres' => ['required', 'integer'],
        ];
    }
}
