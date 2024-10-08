<?php

namespace App\Http\Requests\Pump;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePumpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('pump'));
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
            'guid' => ['required', 'string'],
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'cents_per_litre' => ['required', 'integer'],
            'pulses_per_litre' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ];
    }
}
