<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Toolkit;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class ToolkitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to seed vsla data from csv file');
        $csvPath = database_path('seeders/Data/Toolkits.csv');
        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);

            return;
        }

        $file = fopen($csvPath, 'r');

        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Found $rowCount records to import.");
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('toolkits')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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

                if (empty(mb_trim($data[1] ?? ''))) {
                    $row++;
                    $progressBar->advance();

                    continue;
                }

                Toolkit::create([
                    'name' => mb_trim($data[1] ?? ''),
                    'gender' => mb_trim($data[2] ?? ''),
                    'id_number' => mb_trim($data[3] ?? ''),
                    'business_name' => mb_trim($data[4] ?? ''),
                    'telephone' => mb_trim($data[5] ?? ''),
                    'sector' => mb_trim($data[6] ?? ''),
                    'cell' => mb_trim($data[7] ?? ''),
                    'village' => mb_trim($data[8] ?? ''),
                    'cohort' => $this->cohortDate($data[9] ?? ''),

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
        $this->command->info('Toolkits data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Toolkit::first();
            $this->command->info("Name: $example->name, School: $example->sector, Option: $example->business_name");
        }

    }

    public function cohortDate(?string $dateString): ?string
    {
        if (empty($dateString)) {
            return null;
        }

        try {

            if (preg_match('/^\d{4}$/', $dateString)) {
                return $dateString.'-01-01';
            }

            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dateString)) {
                return Carbon::createFromFormat('d/m/Y', $dateString)->format('Y-m-d');
            }

            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dateString)) {
                return Carbon::createFromFormat('m/d/Y', $dateString)->format('Y-m-d');
            }

            return Carbon::parse($dateString)->format('Y-m-d');

        } catch (Exception $e) {
            Log::warning("Could not parse date: '$dateString' - ".$e->getMessage());

            return null;
        }
    }
}
