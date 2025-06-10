<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateEmpowermentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('empowerment_edit');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'sector' => [
                'string',
                'required',
            ],
            'support' => [
                'string',
                'required',
            ],
            'support_date' => [
                'required',
                'date_format:'.config('panel.date_format'),
            ],
            'supported_children' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
