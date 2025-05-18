<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Project;
use App\Models\Toolkit;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

final class ToolkitImport implements SkipsEmptyRows, SkipsOnError, SkipsOnFailure, ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;

    private int $rowsImported = 0;

    private int $defaultProjectId = 1;

    /**
     * @throws Throwable
     */
    public function collection(Collection $rows): void
    {
        // Check if we have valid data before proceeding
        if ($rows->isEmpty()) {
            Log::warning('No data rows found in import file.');

            return;
        }

        // Get the first available project_id if needed
        if ($this->defaultProjectId <= 0) {
            try {
                $project = Project::first();
                $this->defaultProjectId = $project ? $project->id : 1;
            } catch (Throwable $e) {
                Log::error('Error fetching default project: '.$e->getMessage());
                $this->defaultProjectId = 1;
            }
        }

        foreach ($rows as $row) {
            try {
                DB::beginTransaction();

                // Clean and prepare data
                $cleanedRow = $this->cleanRow($row);

                // Create the toolkit
                $toolkit = new Toolkit([
                    'uuid' => (string) Str::uuid(),
                    'project_id' => $this->defaultProjectId,
                    'name' => $cleanedRow['name'],
                    'gender' => $cleanedRow['gender'],
                    'identification_number' => $cleanedRow['identification_number'],
                    'phone_number' => $cleanedRow['phone_number'],
                    'tvet_attended' => $cleanedRow['tvet_attended'],
                    'option' => $cleanedRow['option'],
                    'level' => $cleanedRow['level'],
                    'training_intake' => $cleanedRow['training_intake'],
                    'reception_date' => $cleanedRow['reception_date'],
                    'toolkit_received' => $cleanedRow['toolkit_received'],
                    'toolkit_cost' => $cleanedRow['toolkit_cost'],
                    'subsidized_percent' => $cleanedRow['subsidized_percent'],
                    'sector' => $cleanedRow['sector'],
                    'total' => $cleanedRow['total'],
                ]);

                $toolkit->save();
                $this->rowsImported++;

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                Log::error('Error processing row during import: '.$e->getMessage(), [
                    'row' => $row->toArray(),
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }
        }
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'gender' => 'nullable|string',  // Removed in:M,F to be more permissive during import
            'identification_number' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'tvet_attended' => 'nullable|string',
            'option' => 'nullable|string',
            'level' => 'nullable|string',
            'training_intake' => 'nullable|string',
            'reception_date' => 'nullable',
            'toolkit_received' => 'nullable|string',
            'toolkit_cost' => 'nullable',
            'subsidized_percent' => 'nullable',
            'sector' => 'nullable|string',
            'total' => 'nullable',
        ];
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

    /**
     * Clean and transform row data
     */
    private function cleanRow(Collection $row): array
    {
        $cleanRow = [];

        // Handle text fields
        $textFields = [
            'name', 'gender', 'identification_number', 'phone_number',
            'tvet_attended', 'option', 'level', 'training_intake',
            'toolkit_received', 'sector',
        ];

        foreach ($textFields as $field) {
            $cleanRow[$field] = $row[$field] ?? null;

            // Ensure valid string value
            if (is_string($cleanRow[$field])) {
                $cleanRow[$field] = mb_trim($cleanRow[$field]);

                // Convert empty strings to null
                if ($cleanRow[$field] === '') {
                    $cleanRow[$field] = null;
                }
            }
        }

        // Handle numeric fields
        $numericFields = ['toolkit_cost', 'subsidized_percent', 'total'];
        foreach ($numericFields as $field) {
            $value = $row[$field] ?? null;

            // Convert to valid numeric value
            if (is_numeric($value)) {
                $cleanRow[$field] = (float) $value;
            } else {
                $cleanRow[$field] = null;
            }
        }

        // Handle date fields
        try {
            $dateValue = $row['reception_date'] ?? null;

            if (! empty($dateValue)) {
                // Try to parse the date using Carbon
                if (is_string($dateValue)) {
                    // Handle Excel date format (numeric timestamp)
                    if (is_numeric($dateValue)) {
                        // Convert Excel date to Carbon date
                        $cleanRow['reception_date'] = Carbon::instance(Date::excelToDateTimeObject($dateValue));
                    } else {
                        // Try parsing as string date
                        $cleanRow['reception_date'] = Carbon::parse($dateValue);
                    }
                } elseif ($dateValue instanceof DateTimeImmutable) {
                    $cleanRow['reception_date'] = Carbon::instance($dateValue);
                } else {
                    $cleanRow['reception_date'] = null;
                }
            } else {
                $cleanRow['reception_date'] = null;
            }
        } catch (Throwable $e) {
            Log::warning('Could not parse date: '.($dateValue ?? 'null'), [
                'error' => $e->getMessage(),
            ]);
            $cleanRow['reception_date'] = null;
        }

        return $cleanRow;
    }
}
