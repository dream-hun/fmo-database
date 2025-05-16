<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class EditToolKitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('toolkit_edit');
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'integer',
                'exists:projects,id',
            ],
            'name' => [
                'required',
                'string',
            ],
            'gender' => [
                'nullable',
                'string',
            ],
            'identification_number' => [
                'nullable',
                'string',
            ],
            'phone_number' => [
                'nullable',
                'string',
            ],
            'tvet_attended' => [
                'nullable',
                'string',
            ],
            'option' => [
                'nullable',
                'string',
            ],
            'level' => [
                'nullable',
                'string',
            ],
            'training_intake' => [
                'nullable',
                'string',
            ],
            'reception_date' => [
                'nullable',
                'string',
            ],
            'toolkit_received' => [
                'nullable',
                'string',
            ],
            'toolkit_cost' => [
                'nullable',
                'numeric',
            ],
            'subsidized_percent' => [
                'nullable',
                'numeric',
            ],
            'sector' => [
                'nullable',
                'string',
            ],
            'total' => [
                'nullable',
                'numeric',
            ],
        ];
    }
}
