<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class ImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('scholarship_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:csv,xlsx',
                'max:10240', // 10MB max file size
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'file.required' => 'Please select a file to import',
            'file.file' => 'The uploaded file is invalid',
            'file.mimes' => 'The file must be a CSV or Excel file',
            'file.max' => 'The file size must not exceed 10MB',
        ];
    }
}
