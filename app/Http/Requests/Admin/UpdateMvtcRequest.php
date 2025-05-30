<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateMvtcRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('mvtc_edit');
    }

    public function rules(): array
    {
        return [
            'reg_no' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'required',
            ],
            'student' => [
                'string',
                'nullable',
            ],
            'student_contact' => [
                'string',
                'nullable',
            ],
            'trade' => [
                'string',
                'nullable',
            ],
            'village' => [
                'string',
                'nullable',
            ],
            'cell' => [
                'string',
                'nullable',
            ],
            'sector' => [
                'string',
                'nullable',
            ],
            'resident_district' => [
                'string',
                'nullable',
            ],
            'education_level' => [
                'string',
                'nullable',
            ],
            'payment_mode' => [
                'string',
                'nullable',
            ],
            'intake' => [
                'string',
                'nullable',
            ],
            'graduation_date' => [
                'string',
                'nullable',
            ],
        ];
    }
}
