<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Girinka;
use App\Models\Project;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class GirinkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/Data/Girinka.csv');

        echo "Looking for CSV file at: {$csvFile}\n";

        if (! file_exists($csvFile)) {
            echo "ERROR: Girinka CSV file not found: {$csvFile}\n";

            return;
        }

        echo "CSV file found!\n";

        // Get default project ID (assuming there's at least one project in the database)
        $defaultProjectId = Project::first()?->id;
        echo 'Default Project ID: '.($defaultProjectId ?? 'NULL')."\n";

        // If no project exists, create a default one
        if ($defaultProjectId === null) {
            $project = Project::create([
                'name' => 'Default Project',
                'description' => 'Created by GirinkaSeeder',
            ]);
            $defaultProjectId = $project->id;
            echo "Created default project with ID: {$defaultProjectId}\n";
        }

        // Read and parse CSV file
        $this->seedFromCsv($csvFile, $defaultProjectId);
    }

    /**
     * Seed girinkas data from CSV file
     *
     * @param  string  $csvFile  Path to CSV file
     * @param  int|null  $projectId  Default project ID
     */
    private function seedFromCsv(string $csvFile, ?int $projectId = null): void
    {
        $handle = fopen($csvFile, 'r');

        if ($handle === false) {
            echo "ERROR: Unable to open CSV file: {$csvFile}\n";

            return;
        }

        echo "Successfully opened CSV file\n";

        // Count total rows for progress calculation
        $totalRows = 0;
        while (fgetcsv($handle) !== false) {
            $totalRows++;
        }
        rewind($handle);

        // Skip header row
        $header = fgetcsv($handle);
        $totalRows--; // Exclude header from count

        echo "Found {$totalRows} records to process\n";
        echo "Starting import...\n";

        // Process each row
        $count = 0;
        $errorCount = 0;
        $lastProgressPercent = 0;

        while (($data = fgetcsv($handle)) !== false) {
            // Skip empty rows
            if (empty($data[1])) {
                continue;
            }

            try {
                $this->createGirinkaFromCsvRow($data, $projectId);
                $count++;

                // Show progress
                $currentPercent = floor(($count + $errorCount) / $totalRows * 100);
                if ($currentPercent >= $lastProgressPercent + 5) {
                    echo "Progress: {$currentPercent}% ({$count} records imported)\n";
                    $lastProgressPercent = $currentPercent;
                }
            } catch (Exception $e) {
                $errorCount++;
                // Log error but don't show in console to keep output clean
                $rowNum = $count + $errorCount;
                Log::error("Error seeding girinka on row {$rowNum}: {$e->getMessage()}", [
                    'data' => $data,
                ]);
            }
        }

        fclose($handle);
        echo "\nImport completed:\n";
        echo "✓ {$count} girinka records successfully imported\n";

        if ($errorCount > 0) {
            echo "✗ {$errorCount} records failed (see logs for details)\n";
        }
    }

    /**
     * Create a girinka record from CSV row data
     *
     * @param  array  $data  CSV row data
     * @param  int|null  $projectId  Default project ID
     */
    private function createGirinkaFromCsvRow(array $data, ?int $projectId = null): void
    {
        // Map CSV columns to model attributes
        $girinkaData = [
            'uuid' => Str::uuid(),
            'names' => $data[1] ?? null,
            'gender' => $data[2] ?? null,
            'id_number' => $this->cleanIdNumber($data[3] ?? null),
            'sector' => $data[4] ?? null,
            'village' => $data[5] ?? null,
            'cell' => $data[6] ?? null,
            'distribution_date' => $this->parseDistributionDate($data[7] ?? null),
            'm_status' => $data[8] ?? null,
            'pass_over' => ! empty($data[9]) ? $data[9] : null,
            'telephone' => $data[10] ?? null,
            'comment' => $data[11] ?? null,
            'project_id' => $projectId,
        ];

        Girinka::create($girinkaData);
    }

    /**
     * Clean ID number by removing asterisk prefix
     */
    private function cleanIdNumber(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        return mb_ltrim($idNumber, '*');
    }

    /**
     * Parse distribution date from various formats
     */
    private function parseDistributionDate(?string $dateString): ?string
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            // Handle year-only format
            if (preg_match('/^\d{4}$/', $dateString)) {
                return $dateString.'-01-01';
            }

            // Parse various date formats
            return Carbon::parse($dateString)->format('Y-m-d');
        } catch (Exception $e) {
            Log::warning('Could not parse date: '.$dateString);

            return null;
        }
    }
}
