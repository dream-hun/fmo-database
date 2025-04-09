<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tank;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/Data/Tanks.csv');

        echo "Looking for CSV file at: {$csvFile}\n";

        if (! file_exists($csvFile)) {
            echo "ERROR: Tanks CSV file not found: {$csvFile}\n";

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
                'description' => 'Created by TankSeeder',
            ]);
            $defaultProjectId = $project->id;
            echo "Created default project with ID: {$defaultProjectId}\n";
        }

        // Read and parse CSV file
        $this->seedFromCsv($csvFile, $defaultProjectId);
    }

    /**
     * Seed tanks data from CSV file
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

        // Skip header rows (there are 2 header rows in this CSV)
        fgetcsv($handle); // Skip first header row
        fgetcsv($handle); // Skip second header row
        $totalRows -= 2; // Exclude header rows from count

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
                $this->createTankFromCsvRow($data, $projectId);
                $count++;

                // Show progress
                $currentPercent = floor(($count + $errorCount) / $totalRows * 100);
                if ($currentPercent >= $lastProgressPercent + 5) {
                    echo "Progress: {$currentPercent}% ({$count} records imported)\n";
                    $lastProgressPercent = $currentPercent;
                }
            } catch (\Exception $e) {
                $errorCount++;
                // Log error but don't show in console to keep output clean
                $rowNum = $count + $errorCount;
                Log::error("Error seeding tank on row {$rowNum}: {$e->getMessage()}", [
                    'data' => $data,
                ]);
            }
        }

        fclose($handle);
        echo "\nImport completed:\n";
        echo "✓ {$count} tank records successfully imported\n";

        if ($errorCount > 0) {
            echo "✗ {$errorCount} records failed (see logs for details)\n";
        }
    }

    /**
     * Create a tank record from CSV row data
     *
     * @param  array  $data  CSV row data
     * @param  int|null  $projectId  Default project ID
     */
    private function createTankFromCsvRow(array $data, ?int $projectId = null): Tank
    {
        // Map CSV columns to model attributes
        $tankData = [
            'uuid' => Str::uuid(),
            'project_id' => $projectId,
            'names' => $data[1] ?? null,
            'gender' => $this->normalizeGender($data[2] ?? null),
            'id_number' => $this->cleanIdNumber($data[3] ?? null),
            'sector' => $data[4] ?? null,
            'cell' => $data[5] ?? null,
            'village' => $data[6] ?? null,
            'no_of_tank' => $data[7] ?? null,
            'distribution_date' => $this->parseDistributionDate($data[8] ?? null),
            'comment' => $data[9] ?? null,
        ];

        return Tank::create($tankData);
    }

    /**
     * Clean ID number by removing asterisk prefix
     */
    private function cleanIdNumber(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        return ltrim($idNumber, '*');
    }

    /**
     * Normalize gender value to match the model's expected format
     */
    private function normalizeGender(?string $gender): ?string
    {
        if (empty($gender)) {
            return null;
        }

        $gender = strtoupper(trim($gender));

        // Handle variations of gender values
        if (in_array($gender, ['MALE', 'M'])) {
            return 'M';
        } elseif (in_array($gender, ['FEMALE', 'F'])) {
            return 'F';
        }

        return $gender;
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
        } catch (\Exception $e) {
            Log::warning('Could not parse date: '.$dateString);

            return null;
        }
    }
}
