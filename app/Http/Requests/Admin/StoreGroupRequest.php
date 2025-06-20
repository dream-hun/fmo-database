<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('group_create');
    }

    public function rules(): array
    {
        return [
            'code' => [
                'string',
                'required',
                'unique:groups',
            ],
            'name' => [
                'string',
                'required',
            ],
            'representer' => [
                'string',
                'nullable',
            ],
            'representer_phone' => [
                'string',
                'nullable',
            ],
            'mou_signed_at' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
            'number_of_members' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
