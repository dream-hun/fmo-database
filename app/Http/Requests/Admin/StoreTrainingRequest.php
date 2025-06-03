<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

final class StoreTrainingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('training_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'national' => [
                'string',
                'nullable',
            ],
            'district' => [
                'string',
                'nullable',
            ],
            'sector' => [
                'string',
                'nullable',
            ],
            'telephone' => [
                'string',
                'nullable',
            ],
            'training_given' => [
                'string',
                'nullable',
            ],
            'position' => [
                'string',
                'nullable',
            ],
            'institution' => [
                'string',
                'nullable',
            ],
            'training_date' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
