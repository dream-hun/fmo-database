<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreIndividualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('individual_create');
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
            'telephone' => [
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
        ];
    }
}
