<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreGirinkaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('girinka_create');
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
                'nullable',
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
            'distribution_date' => [
                'required',
                'date_format:'.config('panel.date_format'),
            ],
            'm_status' => [
                'string',
                'nullable',
            ],
            'telephone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
