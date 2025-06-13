<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateToolkitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('toolkit_edit');
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
            'business_name' => [
                'string',
                'required',
            ],
            'telephone' => [
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
            'cohort' => [
                'required',
                'date_format:'.config('panel.date_format'),
            ],
        ];
    }
}
