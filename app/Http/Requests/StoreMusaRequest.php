<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreMusaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('musa_create');
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
            'family_members' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'support_given' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'support_date' => [
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
        ];
    }
}
