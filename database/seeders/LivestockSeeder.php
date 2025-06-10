<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Livestock;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class LivestockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting importing Livestocks Distributions');
        $csvPath = database_path('seeders/Data/Livestocks.csv');
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
        DB::table('livestocks')->truncate();
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

                Livestock::create([

                    'name' => mb_trim($data[1] ?? ''),
                    'id_number' => $this->cleanIdNumber($data[2] ?? ''),
                    'sector' => mb_trim($data[3] ?? ''),
                    'village' => mb_trim($data[4] ?? ''),
                    'type'=>mb_trim($data[5] ?? ''),
                    'distribution_date' => $this->parseDistributionDate($data[6] ?? ''),
                    'number' => mb_trim($data[7] ?? ''),
                    'gender' => mb_trim($data[8] ?? ''),
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
        $this->command->info('Livestocks distribution data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Livestock::first();
            $this->command->info("Name: $example->name, Sector: $example->sector, Received livestocks: $example->number");
        }
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
        } catch (Exception) {
            Log::warning('Could not parse date: '.$dateString);

            return null;
        }
    }
}

