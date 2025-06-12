<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('member_edit');
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
                'unique:members,id_number,'.request()->route('member')->id,
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
