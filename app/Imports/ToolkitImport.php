<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Toolkit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Validators\Failure;
use PHPUnit\Event\Code\Throwable;

final class ToolkitImport implements SkipsOnError, ToModel, WithHeadingRow, WithValidation, WithChunkReading, WithBatchInserts
{
    private array $failures = [];
    private int $rowsImported = 0;

    public function prepareForValidation($data, $index)
    {
        return array_map(static function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $data);
    }

    public function model(array $row): ?Toolkit
    {
        $data = [
            'uuid' => (string) Str::uuid(),
            'project_id' => 1,
        ];

        // Map fields with type casting and null handling
        $fields = [
            'name' => 'string',
            'gender' => 'string',
            'identification_number' => 'string',
            'phone_number' => 'string',
            'tvet_attended' => 'string',
            'option' => 'string',
            'level' => 'string',
            'training_intake' => 'string',
            'reception_date' => 'string',
            'toolkit_received' => 'string',
            'toolkit_cost' => 'float',
            'subsidized_percent' => 'float',
            'sector' => 'string',
            'total' => 'float'
        ];

        foreach ($fields as $field => $type) {
            if (!isset($row[$field]) || $row[$field] === '') {
                $data[$field] = null;
                continue;
            }

            $data[$field] = $type === 'float' ? (float) $row[$field] : (string) $row[$field];
        }

        $toolkit = new Toolkit($data);
        $toolkit->save();
        $this->rowsImported++;

        // Return null to free memory
        return null;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'gender' => 'nullable|string',
            'identification_number' => 'nullable',
            'phone_number' => 'nullable',
            'tvet_attended' => 'nullable|string',
            'option' => 'nullable|string',
            'level' => 'nullable|string',
            'training_intake' => 'nullable|string',
            'reception_date' => 'nullable|string',
            'toolkit_received' => 'nullable|string',
            'toolkit_cost' => 'nullable|numeric',
            'subsidized_percent' => 'nullable|numeric',
            'sector' => 'nullable|string',
            'total' => 'nullable|numeric',
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

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 500; // Process 500 rows at a time to reduce memory usage
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 50; // Insert 100 records at a time to optimize database performance
    }
}
