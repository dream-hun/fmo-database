<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreEcdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('ecd_create');
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
            'academic_year' => [
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
            'father_name' => [
                'string',
                'nullable',
            ],
            'mother_name' => [
                'string',
                'nullable',
            ],
            'home_phone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
