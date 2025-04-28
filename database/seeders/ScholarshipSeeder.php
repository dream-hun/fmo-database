<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Scholarship;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding scholarship data from CSV...');

        // Get the path to the CSV file
        $csvPath = database_path('seeders/Data/Scholarship.csv');

        // Check if file exists
        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);

            return;
        }

        // Read CSV file
        $file = fopen($csvPath, 'r');

        // Get headers
        $headers = fgetcsv($file);

        // Count the number of rows for the progress bar (excluding header)
        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Found {$rowCount} records to import.");

        // Create a progress bar
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        // Truncate the table before seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('scholarships')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Process each row
        $row = 0;
        $successCount = 0;
        $errorCount = 0;

        while (($data = fgetcsv($file)) !== false) {
            // Skip header row
            if ($row === 0) {
                $row++;
                continue;
            }

            try {
                // Skip empty rows
                if (empty(mb_trim($data[1] ?? ''))) {
                    $row++;
                    $progressBar->advance();
                    continue;
                }

                // Map CSV data to model fields with proper data cleaning
                Scholarship::create([
                    'uuid' => Str::uuid(),
                    'project_id' => 2,
                    'names' => mb_trim($data[1] ?? ''),
                    'gender' => mb_trim($data[2] ?? ''),
                    'id_number' => mb_trim($data[3] ?? ''),
                    'district' => mb_trim($data[4] ?? ''),
                    'sector' => mb_trim($data[5] ?? ''),
                    'cell' => mb_trim($data[6] ?? ''),
                    'village' => mb_trim($data[7] ?? ''),
                    'telephone' => mb_trim($data[8] ?? ''),
                    'email' => mb_trim($data[9] ?? ''),
                    'school' => mb_trim($data[10] ?? ''),
                    'study_option' => mb_trim($data[11] ?? ''),
                    'entrance_year' => mb_trim($data[14] ?? ''),
                ]);

                $successCount++;
            } catch (Exception $e) {
                $errorCount++;
                if ($errorCount <= 5) {
                    $this->command->error("Error processing row {$row}: ".$e->getMessage());
                } elseif ($errorCount === 6) {
                    $this->command->error('Additional errors exist but are not being displayed...');
                }
            }

            $progressBar->advance();
            $row++;
        }

        // Finish the progress bar
        $progressBar->finish();

        // Close the file
        fclose($file);

        $this->command->newLine(2);
        $this->command->info('Scholarship data seeded successfully!');
        $this->command->info("{$successCount} records imported, {$errorCount} errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Scholarship::first();
            $this->command->info("Name: {$example->names}, School: {$example->school}, Study Option: {$example->study_option}");
        }
    }
}
