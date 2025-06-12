<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('transaction_edit');
    }

    public function rules(): array
    {
        return [
            'group_id' => [
                'required',
                'integer',
            ],
            'member_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'done_at' => [
                'required',
                'date_format:'.config('panel.date_format'),
            ],
        ];
    }
}
