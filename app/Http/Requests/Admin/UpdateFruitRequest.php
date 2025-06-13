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
                'required',
            ],
            'mangoes' => [
                'string',
                'nullable',
            ],
            'avocado' => [
                'string',
                'nullable',
            ],
            'papaya' => [
                'string',
                'nullable',
            ],
            'oranges' => [
                'string',
                'nullable',
            ],
            'telephone' => [
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
