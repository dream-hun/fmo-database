<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Urgent;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UrgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to seed urgent community support data from csv file');
        $csvPath = database_path('seeders/Data/Urgent.csv');
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
        DB::table('urgents')->truncate();
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

                Urgent::create([

                    'name' => mb_trim($data[1] ?? ''),
                    'gender' => mb_trim($data[2] ?? ''),
                    'id_number' => $this->cleanUpId($data[3] ?? ''),
                    'sector' => mb_trim($data[4] ?? ''),
                    'cell' => mb_trim($data[5] ?? ''),
                    'village' => mb_trim($data[6] ?? ''),
                    'phone_number' => mb_trim($data[7] ?? ''),
                    'support' => mb_trim($data[8] ?? ''),
                    'support_date' => $this->parseDistributionDate($data[9] ?? ''),
                    'benefiting_members' => mb_trim($data[10] ?? ''),

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
        $this->command->info('Urgent community data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Urgent::first();
            $this->command->info("Name: $example->name, Sector: $example->sector, Support: $example->support");
        }
    }

    private function cleanUpId(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        return mb_ltrim($idNumber, '*');

    }

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
