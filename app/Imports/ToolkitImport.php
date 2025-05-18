<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Toolkit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

final class ToolkitImport implements SkipsOnError, SkipsOnFailure, ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    private array $failures = [];

    private int $rowsImported = 0;

    public function model(array $row): ?Toolkit
    {
        try {
            // Format dates if they exist
            $receptionDate = null;
            if (! empty($row['reception_date'])) {
                try {
                    $receptionDate = $row['reception_date'];
                    // You could add date formatting here if needed
                } catch (Throwable $e) {
                    Log::warning('Invalid reception date format', [
                        'value' => $row['reception_date'] ?? 'null',
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $toolkitCost = ! empty($row['toolkit_cost']) ? (float) $row['toolkit_cost'] : null;
            $subsidizedPercent = ! empty($row['subsidized_percent']) ? (float) $row['subsidized_percent'] : null;
            $total = ! empty($row['total']) ? (float) $row['total'] : null;

            $toolkit = new Toolkit([
                'uuid' => (string) Str::uuid(),
                'project_id' => 1,
                'name' => $row['name'],
                'gender' => $row['gender'] ?? null,
                'identification_number' => $row['identification_number'] ?? null,
                'phone_number' => $row['phone_number'] ?? null,
                'tvet_attended' => $row['tvet_attended'] ?? null,
                'option' => $row['option'] ?? null,
                'level' => $row['level'] ?? null,
                'training_intake' => $row['training_intake'] ?? null,
                'reception_date' => $receptionDate,
                'toolkit_received' => $row['toolkit_received'] ?? null,
                'toolkit_cost' => $toolkitCost,
                'subsidized_percent' => $subsidizedPercent,
                'sector' => $row['sector'] ?? null,
                'total' => $total,
            ]);

            $toolkit->save();
            $this->rowsImported++;

            return $toolkit;
        } catch (Throwable $e) {
            Log::error('Error creating toolkit model', [
                'error' => $e->getMessage(),
                'row' => $row,
            ]);

            return null;
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'gender' => 'nullable|string|in:M,F',
            'identification_number' => 'nullable|string',
            'phone_number' => 'nullable|string',
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

    public function onError(Throwable $e): void
    {
        $row = 0;
        Log::error('Toolkit import error on row processing', [
            'message' => $e->getMessage(),
            'row' => $row,
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
        return 100;
    }

    public function batchSize(): int
    {
        return 50;
    }
}
