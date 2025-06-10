<?php

namespace App\Http\Requests\Admin;

use App\Models\Zamuka;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreZamukaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('zamuka_create');
    }

    public function rules(): array
    {
        return [
            'head_of_household_name' => [
                'string',
                'required',
            ],
            'household_id_number' => [
                'string',
                'nullable',
            ],
            'spouse_name' => [
                'string',
                'nullable',
            ],
            'spouse_id_number' => [
                'string',
                'nullable',
            ],
            'sector' => [
                'string',
                'nullable',
            ],
            'cell' => [
                'string',
                'nullable',
            ],
            'village' => [
                'string',
                'nullable',
            ],
            'house_hold_phone' => [
                'string',
                'nullable',
            ],
            'family_size' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'entrance_year' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
