<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Vsla;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class VslaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/Data/Vslas.csv');

        echo "Looking for CSV file at: {$csvFile}\n";

        if (! file_exists($csvFile)) {
            echo "ERROR: Vslas CSV file not found: {$csvFile}\n";

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
                'description' => 'Created by VslaSeeder',
            ]);
            $defaultProjectId = $project->id;
            echo "Created default project with ID: {$defaultProjectId}\n";
        }

        // Read and parse CSV file
        $this->seedFromCsv($csvFile, $defaultProjectId);
    }

    /**
     * Seed VSLAs data from CSV file
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
            if (empty($data[0])) {
                continue;
            }

            try {
                $this->createVslaFromCsvRow($data, $projectId);
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
                Log::error("Error seeding VSLA on row {$rowNum}: {$e->getMessage()}", [
                    'data' => $data,
                ]);
            }
        }

        fclose($handle);
        echo "\nImport completed:\n";
        echo "✓ {$count} VSLA records successfully imported\n";

        if ($errorCount > 0) {
            echo "✗ {$errorCount} records failed (see logs for details)\n";
        }
    }

    /**
     * Create a VSLA record from CSV row data
     *
     * @param  array  $data  CSV row data
     * @param  int|null  $projectId  Default project ID
     */
    private function createVslaFromCsvRow(array $data, ?int $projectId = null): Vsla
    {
        // Map CSV columns to model attributes
        $vslaData = [
            'uuid' => Str::uuid(),
            'project_id' => $projectId,
            'vlsa' => $data[0] ?? null,
            'surname' => $data[1] ?? null,
            'first_name' => $data[2] ?? null,
            'gender' => $this->normalizeGender($data[3] ?? null),
            'id_number' => $this->cleanIdNumber($data[4] ?? null),
            'telephone' => $this->cleanPhoneNumber($data[5] ?? null),
            'sector' => $data[6] ?? null,
            'cell' => $data[7] ?? null,
            'village' => $data[8] ?? null,
        ];

        return Vsla::create($vslaData);
    }

    /**
     * Clean ID number by removing special characters
     */
    private function cleanIdNumber(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        // Remove quotes, asterisks and leading/trailing whitespace
        return mb_trim(str_replace(["'", '*'], '', $idNumber));
    }

    /**
     * Clean phone number by removing special characters
     */
    private function cleanPhoneNumber(?string $phoneNumber): ?string
    {
        if (empty($phoneNumber)) {
            return null;
        }

        // Remove non-numeric characters
        $cleaned = preg_replace('/[^0-9]/', '', $phoneNumber);

        return $cleaned ?: null;
    }

    /**
     * Normalize gender value to match the model's expected format
     */
    private function normalizeGender(?string $gender): ?string
    {
        if (empty($gender)) {
            return null;
        }

        $gender = mb_strtoupper(mb_trim($gender));

        // Handle variations of gender values
        if (in_array($gender, ['MALE', 'M'])) {
            return 'M';
        }
        if (in_array($gender, ['FEMALE', 'F'])) {
            return 'F';
        }

        return $gender;
    }
}
