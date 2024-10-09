<?php

namespace App\Http\Requests\Attendant;

use App\Models\Attendant;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttendantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Attendant::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_number' => 'required|string|unique:attendants',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'tag_id' => 'nullable|string|unique:attendants',
        ];
    }
}
