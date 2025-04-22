<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SchoolFeeding;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

final class SchoolFeedingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Throwable
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL.'Creating school feeding beneficiaries...');

        // Get the path to the CSV file
        $csvPath = database_path('seeders/Data/School Feeding.csv');

        // Check if file exists
        if (! file_exists($csvPath)) {
            $this->command->error(PHP_EOL.'CSV file not found: '.$csvPath);

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
        $progress = $this->command->getOutput()->createProgressBar($rowCount);
        $progress->start();

        // Process each row
        $count = 0;

        // Begin transaction
        DB::beginTransaction();

        try {
            while (($row = fgetcsv($file)) !== false) {
                // Skip empty rows
                if (empty($row[0]) || count(array_filter($row)) < 3) {
                    $progress->advance();

                    continue;
                }

                // Map CSV columns to database fields
                SchoolFeeding::create([
                    'uuid' => Str::uuid(),
                    'project_id' => 2,
                    'name' => mb_trim($row[1] ?? ''), // Surname column
                    'grade' => mb_trim($row[2] ?? ''),
                    'gender' => mb_trim($row[3] ?? ''),
                    'school_name' => mb_trim($row[4] ?? ''),
                    'district' => mb_trim($row[5] ?? ''),
                    'sector' => mb_trim($row[6] ?? ''),
                    'cell' => mb_trim($row[7] ?? ''),
                    'village' => mb_trim($row[8] ?? ''),
                    'fathers_name' => mb_trim($row[9] ?? ''),
                    'mothers_name' => mb_trim($row[10] ?? ''),
                ]);

                $count++;
                $progress->advance();
            }

            // Commit transaction
            DB::commit();

            // Close the file
            fclose($file);

            // Finish the progress bar
            $progress->finish();

            $this->command->info(PHP_EOL."Successfully imported {$count} school feeding beneficiaries.");
        } catch (Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            $this->command->error(PHP_EOL.'Error importing data: '.$e->getMessage());

            // Close the file
            if (is_resource($file)) {
                fclose($file);
            }
        }
    }
}
