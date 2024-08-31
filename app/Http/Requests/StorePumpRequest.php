<?php

namespace App\Http\Requests;

use App\Models\Pump;
use Illuminate\Foundation\Http\FormRequest;

class StorePumpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Pump::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guid' => ['required', 'string', 'unique:pumps'],
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'cents_per_litre' => ['required', 'integer'],
            'pulses_per_litre' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ];
    }
}
