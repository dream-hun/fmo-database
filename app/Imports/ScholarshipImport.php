<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Scholarship;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

final class ScholarshipImport implements SkipsOnError, SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    private array $failures = [];

    private int $rowsImported = 0;

    public function model(array $row): Scholarship
    {
        $scholarship = new Scholarship([
            'uuid' => (string) Str::uuid(),
            'project_id' => 1,
            'names' => $row['names'] ?? null,
            'gender' => $row['gender'] ?? null,
            'id_number' => $row['id_number'] ?? null,
            'district' => $row['district'] ?? null,
            'sector' => $row['sector'] ?? null,
            'cell' => $row['cell'] ?? null,
            'village' => $row['village'] ?? null,
            'telephone' => $row['telephone'] ?? null,
            'email' => $row['email'] ?? null,
            'school' => $row['school'] ?? null,
            'study_option' => $row['study_option'] ?? null,
            'entrance_year' => $row['entrance_year'] ?? null,
        ]);

        // Explicitly save the model to ensure the UUID is properly set
        $scholarship->save();

        // Increment the count of imported rows
        $this->rowsImported++;

        return $scholarship;
    }

    public function rules(): array
    {
        return [
            'names' => 'required|string',
            'entrance_year' => 'required',
            'gender' => 'nullable|string|in:F,M',
            'id_number' => 'nullable|string',
            'district' => 'nullable|string',
            'sector' => 'nullable|string',
            'cell' => 'nullable|string',
            'village' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'school' => 'nullable|string',
            'study_option' => 'nullable|string',
        ];
    }

    public function onError(Throwable $e): void
    {
        Log::error('Scholarship import error: '.$e->getMessage(), [
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
            Log::warning('Scholarship import validation failure', [
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
