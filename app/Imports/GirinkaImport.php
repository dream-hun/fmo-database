<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Girinka;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

final class GirinkaImport implements SkipsOnError, SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    private array $failures = [];

    private int $rowsImported = 0;

    public function model(array $row): Girinka
    {
        $girinka = new Girinka([
            'uuid' => (string) Str::uuid(),
            'project_id' => 1,
            'names' => $row['names'],
            'gender' => $row['gender'],
            'id_number' => $row['id_number'],
            'sector' => $row['sector'],
            'cell' => $row['cell'],
            'village' => $row['village'],
            'distribution_date' => $row['distribution_date'],
            'm_status' => $row['m_status'],
            'pass_over' => $row['pass_over'],
            'telephone' => $row['telephone'],
            'comment' => $row['comment'],

        ]);
        // Explicitly save the model to ensure the UUID is properly set
        $girinka->save();

        // Increment the count of imported rows
        $this->rowsImported++;

        return $girinka;
    }

    public function rules(): array
    {
        return [
            'names' => 'required|string|max:255',
            'gender' => 'string',
            'id_number' => 'string|max:16',
            'sector' => 'string|max:255',
            'cell' => 'string|max:255',
            'village' => 'string|max:255',
            'distribution_date' => 'nullable',
            'm_status' => 'string|max:255',
            'pass_over' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'comment' => 'nullable|string',

        ];
    }

    public function onError(Throwable $e): void
    {
        Log::error('Girinka import error: '.$e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
    }

    /**
     * @param  Failure[]  $failures
     */
    public function onFailure(Failure ...$failures): void
    {
        $this->failures = array_merge($this->failures, $failures);
        foreach ($failures as $failure) {
            Log::warning('Girinka import validation failure', [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values(),
            ]);
        }
    }

    public function getFailures(): array
    {
        return $this->failures;
    }

    /**
     * Get the number of rows imported
     */
    public function getRowsImported(): int
    {
        return $this->rowsImported;
    }
}
