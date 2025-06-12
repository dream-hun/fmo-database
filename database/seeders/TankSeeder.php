<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tank;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class TankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting import from csv file');
        $csvPath = database_path('seeders/Data/Tanks.csv');
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
        DB::table('tanks')->truncate();
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

                Tank::create([

                    'name' => mb_trim($data[1] ?? ''),
                    'gender' => $this->normalizeGender(mb_trim($data[2] ?? '')),
                    'id_number' => $this->cleanIdNumber($data[3] ?? ''),
                    'sector' => mb_trim($data[4] ?? ''),
                    'cell' => mb_trim($data[5] ?? ''),
                    'village' => mb_trim($data[6] ?? ''),
                    'no_of_tank' => mb_trim($data[7] ?? ''),
                    'distribution_date' => $this->parseDistributionDate(mb_trim($data[8] ?? '')),
                    'comment' => mb_trim($data[10] ?? ''),

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
        $this->command->info('Water tanks data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Tank::first();
            $this->command->info("Name: $example->names, Sector: $example->sector, Support: $example->distribution_date");
        }
    }

    private function cleanIdNumber(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        return mb_ltrim($idNumber, '*');
    }

    private function normalizeGender(?string $gender): ?string
    {
        if (empty($gender)) {
            return null;
        }

        $gender = mb_strtoupper(mb_trim($gender));

        if (in_array($gender, ['MALE', 'M'])) {
            return 'M';
        }
        if (in_array($gender, ['FEMALE', 'F'])) {
            return 'F';
        }

        return $gender;
    }

    private function parseDistributionDate(?string $dateString): ?string
    {
        if (empty($dateString)) {
            return null;
        }

        try {

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
