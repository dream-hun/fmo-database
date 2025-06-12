<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateTankRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('tank_edit');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'gender' => [
                'required',
            ],
            'id_number' => [
                'string',
                'required',
            ],
            'sector' => [
                'string',
                'required',
            ],
            'cell' => [
                'string',
                'required',
            ],
            'village' => [
                'string',
                'nullable',
            ],
            'no_of_tank' => [
                'string',
                'nullable',
            ],
            'distribution_date' => [
                'required',
                'date_format:'.config('panel.date_format'),
            ],
        ];
    }
}
