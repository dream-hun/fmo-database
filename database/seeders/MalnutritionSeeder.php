<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Malnutrition;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class MalnutritionSeeder extends Seeder
{
    private array $skippedRows = [];
    private array $errorDetails = [];

    public function run(): void
    {
        $this->command->info("Seeding Malnutrition data from CSV...");
        $csvPath = database_path("seeders/Data/Malnutrition.csv");

        if (!file_exists($csvPath)) {
            $this->command->error("CSV file not found: " . $csvPath);
            return;
        }

        $file = fopen($csvPath, "r");
        $rowCount = count(file($csvPath)) - 1; // Subtract header row
        $this->command->info("Processing $rowCount rows from CSV...");

        $progressBar = $this->command
            ->getOutput()
            ->createProgressBar($rowCount);
        $progressBar->setFormat(
            " %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%"
        );
        $progressBar->start();

        // Clear existing data
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("malnutritions")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $row = 0;
        $successCount = 0;
        $errorCount = 0;
        $skippedCount = 0;

        while (($data = fgetcsv($file)) !== false) {
            if ($row === 0) {
                $row++;
                continue; // Skip header row
            }

            try {
                // Check if row has any meaningful data (not completely empty)
                $hasData = $this->hasAnyData($data);

                if (!$hasData) {
                    $this->skippedRows[] = "Row $row: Completely empty row";
                    $skippedCount++;
                    $progressBar->advance();
                    $row++;
                    continue;
                }

                // Check if name exists (assuming name is required)
                if (empty($this->cleanString($data[0] ?? ""))) {
                    $this->skippedRows[] = "Row $row: Missing required name field";
                    $skippedCount++;
                    $progressBar->advance();
                    $row++;
                    continue;
                }

                // Create record with cleaned and validated data
                Malnutrition::create([
                    "name" => $this->cleanString($data[0] ?? ""),
                    "gender" => $this->cleanString($data[1] ?? null),
                    "age" => $this->validateAge($data[2] ?? null),
                    "health_center" => $this->cleanString($data[3] ?? null),
                    "sector" => $this->cleanString($data[4] ?? null),
                    "cell" => $this->cleanString($data[5] ?? null),
                    "village" => $this->cleanString($data[6] ?? null),
                    "father_name" => $this->cleanString($data[7] ?? null),
                    "mother_name" => $this->cleanString($data[8] ?? null),
                    "home_phone" => $this->cleanString($data[9] ?? null),
                    "package_reception_date" => $this->parseReceptionDate(
                        $data[10] ?? null
                    ),
                ]);

                $successCount++;
            } catch (Exception $e) {
                $errorCount++;
                $errorMessage = "Row $row: " . $e->getMessage();
                $this->errorDetails[] = $errorMessage;

                // Log detailed error information
                Log::error("Malnutrition seeder error", [
                    "row" => $row,
                    "data" => $data,
                    "error" => $e->getMessage(),
                    "trace" => $e->getTraceAsString(),
                ]);

                // Show first 10 errors in console
                if ($errorCount <= 10) {
                    $this->command->error($errorMessage);
                }
            }

            $progressBar->advance();
            $row++;
        }

        $progressBar->finish();
        fclose($file);

        // Display summary
        $this->displaySummary($successCount, $errorCount, $skippedCount);
    }

    /**
     * Check if the row has any meaningful data
     */
    private function hasAnyData(array $data): bool
    {
        foreach ($data as $field) {
            if (!empty(trim($field ?? ""))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Clean and normalize string data
     */
    private function cleanString(?string $value): ?string
    {
        if ($value === null || $value === "") {
            return null;
        }

        $cleaned = mb_trim($value);
        return $cleaned === "" ? null : $cleaned;
    }

    /**
     * Validate and clean age data
     */
    private function validateAge(?string $age): ?int
    {
        if (empty($age)) {
            return null;
        }

        $cleaned = trim($age);

        // Check if it's a valid number
        if (is_numeric($cleaned)) {
            $ageInt = (int) $cleaned;
            // Reasonable age validation (0-150)
            if ($ageInt >= 0 && $ageInt <= 150) {
                return $ageInt;
            }
        }

        // If not valid, log warning and return null
        Log::warning("Invalid age value: $age");
        return null;
    }

    /**
     * Parse reception date with better error handling
     */
    private function parseReceptionDate(?string $dateString): ?string
    {
        if (empty($dateString)) {
            return null;
        }

        $dateString = trim($dateString);

        try {
            // Handle year-only format
            if (preg_match('/^\d{4}$/', $dateString)) {
                return $dateString . "-01-01";
            }

            // Handle various date formats
            $parsedDate = Carbon::parse($dateString);
            return $parsedDate->format("Y-m-d");
        } catch (Exception $e) {
            Log::warning("Could not parse reception date", [
                "date_string" => $dateString,
                "error" => $e->getMessage(),
            ]);

            // Return null instead of error message to avoid database issues
            return null;
        }
    }

    /**
     * Display comprehensive summary of the import process
     */
    private function displaySummary(
        int $successCount,
        int $errorCount,
        int $skippedCount
    ): void {
        $this->command->newLine(2);
        $this->command->info("=== MALNUTRITION DATA IMPORT SUMMARY ===");
        $this->command->info("✅ Successfully imported: $successCount records");
        $this->command->info("❌ Errors encountered: $errorCount records");
        $this->command->info(
            "⏭️  Skipped (empty/invalid): $skippedCount records"
        );

        // Show example of imported data
        if ($successCount > 0) {
            $this->command->newLine();
            $this->command->info("📋 Example of imported data:");
            $example = Malnutrition::first();
            if ($example) {
                $this->command->info("   Name: {$example->name}");
                $this->command->info("   Age: {$example->age}");
                $this->command->info("   Gender: {$example->gender}");
                $this->command->info(
                    "   Health Center: {$example->health_center}"
                );
            }
        }

        // Show skipped rows summary
        if ($skippedCount > 0) {
            $this->command->newLine();
            $this->command->warn("⚠️  Skipped rows details:");
            foreach (array_slice($this->skippedRows, 0, 10) as $skipped) {
                $this->command->warn("   $skipped");
            }
            if (count($this->skippedRows) > 10) {
                $remaining = count($this->skippedRows) - 10;
                $this->command->warn("   ... and $remaining more skipped rows");
            }
        }

        // Show error details
        if ($errorCount > 0) {
            $this->command->newLine();
            $this->command->error("🚨 Error details:");
            foreach (array_slice($this->errorDetails, 0, 10) as $error) {
                $this->command->error("   $error");
            }
            if (count($this->errorDetails) > 10) {
                $remaining = count($this->errorDetails) - 10;
                $this->command->error(
                    "   ... and $remaining more errors (check logs for details)"
                );
            }
        }

        $total = $successCount + $errorCount + $skippedCount;
        $successRate =
            $total > 0 ? round(($successCount / $total) * 100, 2) : 0;
        $this->command->info("📊 Import success rate: {$successRate}%");
    }
}
