<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Musa;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class MusaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $this->command->info('Seeding Musa data from CSV...');
        $csvPath = database_path('seeders/Data/Musa.csv');

        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);

            return;
        }

        $file = fopen($csvPath, 'r');
        $rowCount = count(file($csvPath)) - 1;

        $this->command->info("Seeding $rowCount Musa support records...");
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('musas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $row = 0;
        $successCount = 0;
        $errorCount = 0;

        while (($data = fgetcsv($file)) !== false) {
            if ($row === 0) {
                $row++;

                continue; // Skip header
            }

            try {
                $name = mb_trim($data[1] ?? '');
                if (empty($name)) {
                    $row++;
                    $progressBar->advance();

                    continue;
                }

                Musa::create([
                    'name' => $name,
                    'id_number' => $this->cleanIdNumber($data[2] ?? null),
                    'family_members' => $data[3] ?? null,
                    'support_given' => $data[4] ?? null,
                    'support_date' => $this->parseDistributionDate($data[5] ?? null),
                    'sector' => $data[6] ?? null,
                    'cell' => $data[7] ?? null,
                    'village' => $data[8] ?? null,

                ]);

                $successCount++;
            } catch (Exception $e) {
                $errorCount++;
                if ($errorCount <= 5) {
                    $this->command->error("Error on row $row: ".$e->getMessage());
                } elseif ($errorCount === 6) {
                    $this->command->error('Further errors suppressed...');
                }
            }

            $progressBar->advance();
            $row++;
        }

        fclose($file);
        $progressBar->finish();

        $this->command->newLine(2);
        $this->command->info("Seeding completed: $successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $example = Musa::first();
            $this->command->info("Example record — Name: $example->name, Cell: $example->cell, Village: $example->village");
        }
    }

    /**
     * Clean ID number by removing asterisk prefix.
     */
    private function cleanIdNumber(?string $idNumber): ?string
    {
        return $idNumber ? mb_ltrim($idNumber, '*') : null;
    }

    /**
     * Parse distribution date from various formats.
     */
    private function parseDistributionDate(?string $dateString): ?string
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            // Handle year-only input
            if (preg_match('/^\d{4}$/', $dateString)) {
                return $dateString.'-01-01';
            }

            return Carbon::parse($dateString)->format('Y-m-d');
        } catch (Exception $e) {
            Log::warning('Could not parse date: '.$dateString);

            return null;
        }
    }
}
