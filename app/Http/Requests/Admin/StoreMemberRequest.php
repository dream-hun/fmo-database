<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('member_create');
    }

    public function rules(): array
    {
        return [
            'group_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'id_number' => [
                'string',
                'required',
                'unique:members',
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
        ];
    }
}
