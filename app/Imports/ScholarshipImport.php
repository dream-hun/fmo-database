<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Scholarship;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Str;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

final class ScholarshipImport implements SkipsOnError, SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    /**
     * @var array
     */
    private $failures = [];

    /**
     * @var int
     */
    private $rowsImported = 0;

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            // Log the raw data for debugging
            Log::info('Processing import row', ['row' => $row]);

            // Check for required fields based on database schema and CSV column names
            if (! isset($row['names']) || empty($row['names'])) {
                Log::warning("Missing required field: names", ['row' => $row]);
                return null;
            }
            
            // Normalize column names to handle both formats (with spaces and with underscores)
            $normalizedRow = $this->normalizeRowKeys($row);
            
            // Check for required entrance year field
            if (empty($normalizedRow['entrance_year'])) {
                Log::warning("Missing required field: entrance_year", ['row' => $row]);
                return null;
            }

            // Map gender values to match the model's expected format
            // The CSV already has 'F' and 'M' values, so we can use them directly
            $gender = $row['gender'] ?? null;
            // But also handle lowercase values if they exist
            if (is_string($gender)) {
                if (mb_strtolower($gender) === 'male' || mb_strtolower($gender) === 'm') {
                    $gender = 'M';
                } elseif (mb_strtolower($gender) === 'female' || mb_strtolower($gender) === 'f') {
                    $gender = 'F';
                } elseif (!in_array($gender, ['M', 'F'])) {
                    $gender = 'O'; // Other
                }
            }

            // Create the scholarship with DB transaction for safety
            DB::beginTransaction();
            try {
                // Use the normalized row data for mapping
                $normalizedRow = $this->normalizeRowKeys($row);
                
                // Map CSV column names to database fields
                $scholarship = new Scholarship([
                    'uuid' => Str::uuid(),
                    'project_id' => 2,
                    'names' => $normalizedRow['names'] ?? null,
                    'gender' => $gender,
                    'id_number' => $normalizedRow['id_number'] ?? null,
                    'district' => $normalizedRow['district'] ?? null,
                    'sector' => $normalizedRow['sector'] ?? null,
                    'cell' => $normalizedRow['cell'] ?? null,
                    'village' => $normalizedRow['village'] ?? null,
                    'telephone' => $normalizedRow['telephone'] ?? null,
                    'email' => $normalizedRow['email'] ?? null,
                    'school' => $normalizedRow['school'] ?? null,
                    'study_option' => $normalizedRow['study_option'] ?? null,
                    'entrance_year' => $normalizedRow['entrance_year'] ?? null,
                ]);

                $scholarship->save(); // Explicitly save the model
                $this->rowsImported++;

                DB::commit();
                Log::info('Successfully imported scholarship', [
                    'id' => $scholarship->id,
                    'names' => $scholarship->names,
                ]);

                return $scholarship;
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Failed to save scholarship: '.$e->getMessage(), [
                    'exception' => $e,
                    'row' => $row,
                ]);

                return null;
            }
        } catch (Exception $e) {
            Log::error('Exception in import model method: '.$e->getMessage(), [
                'exception' => $e,
                'row' => $row ?? 'No row data',
            ]);

            return null;
        }
    }

    public function rules(): array
    {
        return [
            'names' => 'required|string|max:255',
            'gender' => 'nullable|string|max:255', // Gender is nullable in the schema
            'id_number' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'sector' => 'nullable|string|max:255',
            'cell' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255', // Telephone is nullable in the schema
            'email' => 'nullable|email|max:255',
            'school' => 'nullable|string|max:255', // School is nullable in the schema
            'study_option' => 'nullable|string|max:255', // Support underscore format
            'year_of_entrance' => 'required|string|max:255', // Support underscore format
        ];
    }

    public function onError(Throwable $e)
    {
        // Log the error
        Log::error('Error importing scholarship: '.$e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }

    /**
     * @param  Failure[]  $failures
     */
    public function onFailure(Failure ...$failures)
    {
        $this->failures = $failures;

        foreach ($failures as $failure) {
            Log::warning('Row validation failed during import', [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values() ?? [],
            ]);
        }
    }

    /**
     * Get the number of rows imported
     */
    public function getRowsImported(): int
    {
        return $this->rowsImported;
    }
    
    /**
     * Normalize row keys to handle different column naming formats
     * This converts keys with spaces to underscores and maps them to our expected database fields
     */
    private function normalizeRowKeys(array $row): array
    {
        $normalized = [];
        $mappings = [
            'names' => ['names'],
            'gender' => ['gender'],
            'id_number' => ['id_number', 'id number', 'id'],
            'district' => ['district', 'districts'],
            'sector' => ['sector'],
            'cell' => ['cell'],
            'village' => ['village'],
            'telephone' => ['telephone', 'phone', 'telehone'],
            'email' => ['email'],
            'school' => ['school'],
            'study_option' => ['study_option', 'study option'],
            'entrance_year' => ['entrance_year', 'year_of_entrance', 'year of entrance'],
        ];
        
        foreach ($mappings as $dbField => $possibleKeys) {
            foreach ($possibleKeys as $key) {
                if (isset($row[$key])) {
                    $normalized[$dbField] = $row[$key];
                    break;
                }
            }
        }
        
        return $normalized;
    }
}
