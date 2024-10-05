<?php

namespace App\Http\Requests\Driver;

use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->can('create', Driver::class)) {
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
            'tag_id' => ['sometimes', 'string', 'unique:drivers,tag_id,except,id'],
            'employee_number' => ['required', 'string', 'min:3', 'max:10', 'unique:drivers'],
            'name' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }
}
