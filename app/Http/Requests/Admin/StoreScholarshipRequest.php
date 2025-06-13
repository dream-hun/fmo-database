<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreScholarshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('scholarship_create');
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
            'telephone' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'school' => [
                'string',
                'required',
            ],
            'study_option' => [
                'string',
                'required',
            ],
            'entrance_year' => [
                'string',
                'required',
            ],
        ];
    }
}
