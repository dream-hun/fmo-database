<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

final class StoreFoodAndHouseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('food_and_house_create');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'id_number' => [
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
            'phone_number' => [
                'string',
                'nullable',
            ],
            'support' => [
                'string',
                'nullable',
            ],
            'date' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
