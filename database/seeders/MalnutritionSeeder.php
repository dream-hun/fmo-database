<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Malnutrition;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class MalnutritionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding malnutrition data from CSV...');

        // Get the path to the CSV file
        $csvPath = database_path('seeders/Data/Malnutrition.csv');

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

        // Create a progress bar
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        // Truncate the table before seeding
        DB::table('malnutritions')->truncate();

        // Process each row
        $row = 0;
        while (($data = fgetcsv($file)) !== false) {
            // Skip header row
            if ($row === 0) {
                $row++;

                continue;
            }

            // Clean and convert data types
            $entryMuac = ! empty(mb_trim($data[13])) ? (float) $data[13] : null;
            $currentlyMuac = ! empty(mb_trim($data[14])) ? (float) $data[14] : null;

            // Parse date with error handling
            $packageReceptionDate = null;
            if (! empty(mb_trim($data[12]))) {
                try {
                    $packageReceptionDate = date('Y-m-d', strtotime(str_replace('/', '-', $data[12])));
                } catch (Exception $e) {
                    $this->command->warning("Invalid date format at row {$row}: {$data[12]}");
                }
            }

            // Extract age value (remove 'Months' text if present)
            $age = null;
            if (! empty(mb_trim($data[4]))) {
                $age = preg_replace('/[^0-9.]/', '', $data[4]);
                $age = ! empty($age) ? (int) $age : null;
            }

            try {
                // Map CSV data to model fields
                Malnutrition::create([
                    'project_id' => 1,
                    'surname' => mb_trim($data[1] ?? ''),
                    'first_name' => mb_trim($data[2] ?? ''),
                    'gender' => mb_trim($data[3] ?? ''),
                    'age' => $age,
                    'health_center' => mb_trim($data[5] ?? ''),
                    'sector' => mb_trim($data[6] ?? ''),
                    'cell' => mb_trim($data[7] ?? ''),
                    'village' => mb_trim($data[8] ?? ''),
                    'father_name' => mb_trim($data[9] ?? ''),
                    'mother_name' => mb_trim($data[10] ?? ''),
                    'home_phone' => mb_trim($data[11] ?? ''),
                    'package_reception_date' => $packageReceptionDate,
                    'entry_muac' => $entryMuac,
                    'currently_muac' => $currentlyMuac,
                    'current_malnutrition_code' => mb_trim($data[15] ?? ''),
                ]);
            } catch (Exception $e) {
                $this->command->error("Error processing row {$row}: ".$e->getMessage());
            }

            // Advance the progress bar
            $progressBar->advance();

            $row++;
        }

        // Finish the progress bar
        $progressBar->finish();

        // Close the file
        fclose($file);

        $this->command->newLine(2);
        $this->command->info('Malnutrition data seeded successfully!');
    }
}
