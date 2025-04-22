<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Individual;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class IndividualSeeder extends Seeder
{
    protected $csvFile = 'database/seeders/Data/Individual.csv';

    protected $projectName = 'Individual Loans';

    protected $successCount = 0;

    protected $errorCount = 0;

    protected $totalRows = 0;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (! file_exists($this->csvFile)) {
            $this->command->error("CSV file not found: {$this->csvFile}");

            return;
        }

        // Count total rows for progress tracking
        $this->totalRows = count(file($this->csvFile)) - 1; // -1 for header row

        // Create progress bar
        $progress = $this->command->getOutput()->createProgressBar($this->totalRows);
        $progress->setFormat(
            "%current%/%max% [%bar%] %percent:3s%%\n"
            ."Speed: %speed% records/sec, Memory: %memory:6s%\n"
            .'Elapsed: %elapsed:6s%, Remaining: %remaining:-6s%'
        );

        $this->command->info("Starting to import {$this->totalRows} individuals...");
        $progress->start();

        // Read CSV file
        $handle = fopen($this->csvFile, 'r');
        $headers = fgetcsv($handle); // Skip header row

        while (($row = fgetcsv($handle)) !== false) {
            try {
                // Map CSV columns to data array
                $data = array_combine($headers, $row);
                $progress->advance();

                // Create the individual record
                Individual::create([
                    'uuid' => Str::uuid(),
                    'project_id' => 1,
                    'name' => $data['Name'] ?? null,
                    'id_number' => mb_ltrim($data['ID'] ?? '', '*'),
                    'business_name' => $data['Business name'] ?? null,
                    'telephone' => $this->cleanPhoneNumber($data['Telephone']),
                    'guardian' => $data['Guarantor '] ?? null,
                    'guardian_phone' => $this->cleanPhoneNumber($data['Guarantor  Phone']),
                    'sector' => $data['Sector'] ?? null,
                    'cell' => $data['Cell'] ?? null,
                    'village' => $data['Village'] ?? null,
                    'loan_amount' => $this->cleanAmount($data['Loan Amount']),
                    'loan_date' => $this->parseDate($data['Loan Date']),
                    'gender' => $this->normalizeGender($data['Gender']),
                ]);

                $this->successCount++;
            } catch (Exception $e) {
                $this->errorCount++;
                Log::error('Error importing individual: '.$e->getMessage());
                Log::error('Row data: '.json_encode($data ?? []));
            }
        }

        fclose($handle);
        $progress->finish();

        // Show final statistics
        $this->command->newLine(2);
        $this->command->info('✓ Import completed:');
        $this->command->info("  - Successfully imported: {$this->successCount}");
        $this->command->info("  - Errors: {$this->errorCount}");

        if ($this->errorCount > 0) {
            $this->command->warn('  - Check the Laravel log file for error details.');
        }
        $this->command->newLine();
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
