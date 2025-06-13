<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreSchoolFeedingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('school_feeding_create');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'grade' => [
                'string',
                'required',
            ],
            'gender' => [
                'required',
            ],
            'school_name' => [
                'string',
                'required',
            ],
            'academic_year' => [
                'string',
                'required',
            ],
            'district' => [
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
                'nullable',
            ],
            'fathers_name' => [
                'string',
                'nullable',
            ],
            'mothers_name' => [
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
