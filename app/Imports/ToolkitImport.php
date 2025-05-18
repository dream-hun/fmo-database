<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Toolkit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use PHPUnit\Event\Code\Throwable;

final class ToolkitImport implements SkipsOnError, ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    private array $failures = [];

    private int $rowsImported = 0;

    public function model(array $row): ?Toolkit
    {

        $toolkits = new Toolkit([

            'uuid' => (string) Str::uuid(),
            'project_id' => 1,
            'name' => $row['name'] ?? null,
            'gender' => $row['gender'] ?? null,
            'identification_number' => $row['identification_number'] ?? null,
            'phone_number' => $row['phone_number'] ?? null,
            'tvet_attended' => $row['tvet_attended'] ?? null,
            'option' => $row['option'] ?? null,
            'level' => $row['level'] ?? null,
            'training_intake' => $row['training_intake'] ?? null,
            'reception_date' => $row['reception_date'] ?? null,
            'toolkit_received' => $row['toolkit_received'] ?? null,
            'toolkit_cost' => $row['toolkit_cost'] ?? null,
            'subsidized_percent' => $row['subsidized_percent'] ?? null,
            'sector' => $row['sector'] ?? null,
            'total' => $row['total'] ?? null,

        ]);
        $toolkits->save();
        $this->rowsImported++;

        return $toolkits;

    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'gender' => 'nullable|string|in:M,F',

        ];
    }

    public function onError(Throwable|\Throwable $e): void
    {

        Log::error('Toolkit import error: '.$e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
    }

    public function onFailure(Failure ...$failures): void
    {
        $this->failures = array_merge($this->failures, $failures);

        foreach ($failures as $failure) {
            Log::warning('Toolkit import validation failure', [
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

    public function getRowsImported(): int
    {
        return $this->rowsImported;
    }

    public function chunkSize(): int
    {
        return 100; // Process 500 rows at a time to reduce memory usage
    }

    public function batchSize(): int
    {
        return 50; // Insert 100 records at a time to optimize database performance
    }
}
