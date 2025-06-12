<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Girinka;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class GirinkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to read data from csv file');
        $csvPath = database_path('seeders/Data/Girinka.csv');
        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);

            return;
        }

        // Read CSV file
        $file = fopen($csvPath, 'r');

        // Count the number of rows for the progress bar (excluding header)
        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Found $rowCount records to import.");
        // Create a progress bar
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('girinkas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $row = 0;
        $successCount = 0;
        $errorCount = 0;
        while (($data = fgetcsv($file)) !== false) {

            if ($row === 0) {
                $row++;

                continue;
            }

            try {
                if (empty(mb_trim($data[1] ?? ''))) {
                    $row++;
                    $progressBar->advance();

                    continue;
                }

                // Create the individual record
                Girinka::create([
                    'name' => $data[1] ?? null,
                    'gender' => $this->normalizeGender($data[2] ?? null),
                    'id_number' => $this->cleanIdNumber(mb_ltrim($data[3] ?? '', '*')),
                    'sector' => $data[4] ?? null,
                    'village' => mb_trim($data[5] ?? ''),
                    'cell' => mb_trim($data[6] ?? null),
                    'distribution_date' => $this->parseDistributionDate(mb_trim($data[7] ?? null)),
                    'm_status' => mb_rtrim($data[8] ?? null),
                    'pass_over' => mb_trim($data[9] ?? null),
                    'telephone' => $this->cleanPhoneNumber(mb_trim($data[10])),
                    'comment' => mb_trim($data[11]),

                ]);

                $successCount++;
            } catch (Exception $e) {
                $errorCount++;
                if ($errorCount <= 5) {
                    $this->command->error("Error processing row $row: ".$e->getMessage());
                } elseif ($errorCount === 6) {
                    $this->command->error('Additional errors exist but are not being displayed...');
                }
            }

            $progressBar->advance();
            $row++;
        }

        $progressBar->finish();

        fclose($file);
        $this->command->newLine(2);
        $this->command->info('Girinka data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Girinka::first();
            $this->command->info("Name: $example->name, Sector: $example->sector, Gender: $example->gender");
        }

    }

    protected function normalizeGender(?string $gender): ?string
    {
        if (empty($gender)) {
            return null;
        }

        return mb_strtoupper($gender) === 'F' ? 'Female' : 'Male';
    }

    protected function cleanPhoneNumber(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        // Remove any non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If it starts with 25, remove it
        if (str_starts_with($phone, '25')) {
            $phone = mb_substr($phone, 2);
        }

        // If it's not 9 or 10 digits, return null
        if (! in_array(mb_strlen($phone), [9, 10])) {
            return null;
        }

        return $phone;
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
