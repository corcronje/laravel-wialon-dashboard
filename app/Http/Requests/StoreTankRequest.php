<?php

namespace App\Http\Requests;

use App\Models\Tank;
use Illuminate\Foundation\Http\FormRequest;

class StoreTankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Tank::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'volume_in_litres' => 'required',
            'current_volume_in_litres' => 'required',
        ];
    }
}
