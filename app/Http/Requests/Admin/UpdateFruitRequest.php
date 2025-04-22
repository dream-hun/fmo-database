<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateFruitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('fruit_edit');
    }

    public function rules(): array
    {
        return [
            'surname' => [
                'string',
                'required',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'gender' => [
                'string',
                'nullable',
            ],
            'national' => [
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
            'mangoes' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'avocado' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'papaya' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'oranges' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'telephone' => [
                'string',
                'nullable',
            ],
            'distribution_date' => [
                'string',
                'nullable',
            ],
            'project_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
