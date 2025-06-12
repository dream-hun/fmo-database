<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Individual;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class IndividualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Individual Microcredit data from CSV...');
        $csvPath = database_path('seeders/Data/Individual.csv');
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
        DB::table('individuals')->truncate();
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
                Individual::create([
                    'name' => $data[1] ?? null,
                    'id_number' => mb_ltrim($data[2] ?? '', '*'),
                    'business_name' => $data[3] ?? null,
                    'telephone' => $this->cleanPhoneNumber($data[4] ?? ''),
                    'guardian' => $data[5] ?? null,
                    'guardian_phone' => $this->cleanPhoneNumber($data[6] ?? ''),
                    'sector' => $data[7] ?? null,
                    'cell' => $data[8] ?? null,
                    'village' => $data[9] ?? null,
                    'loan_amount' => $this->cleanAmount($data[10]),
                    'loan_date' => $this->parseDate($data[11]),
                    'gender' => $this->normalizeGender($data[12]),
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
        $this->command->info('Scholarship data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Individual::first();
            $this->command->info("Name: $example->name, Bussiness Name: $example->business_name, Gender: $example->gender");
        }
    }

    /**
     * Clean and format the phone number
     */
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
     * Parse the date from various formats
     */
    protected function parseDate(?string $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Clean the amount string and convert to integer
     */
    protected function cleanAmount(?string $amount): ?int
    {
        if (empty($amount)) {
            return null;
        }

        // Remove any non-digit characters except decimal point
        $amount = preg_replace('/[^0-9.]/', '', $amount);

        return (int) $amount;
    }

    /**
     * Normalize gender value
     */
    protected function normalizeGender(?string $gender): ?string
    {
        if (empty($gender)) {
            return null;
        }

        return mb_strtoupper($gender) === 'F' ? 'Female' : 'Male';
    }
}
