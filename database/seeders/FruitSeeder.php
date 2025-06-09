<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Fruit;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to seed Fruit trees data from csv file');
        $csvPath = database_path('seeders/Data/Trees.csv');
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
        DB::table('fruits')->truncate();
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
                Fruit::create([
                    'name' => mb_trim($data[1]),
                    'gender' => mb_trim($data[2]),
                    'id_number' => $this->cleanIdNumber($data[3] ?? ''),
                    'sector' => mb_trim($data[4]),
                    'cell' => mb_trim($data[5]),
                    'village' => mb_trim($data[6]),
                    'mangoes' => $data[7],
                    'avocado' => $data[8],
                    'papaya' => $data[9],
                    'oranges' => $data[10],
                    'telephone' => $this->cleanPhoneNumber($data[11]),
                    'distribution_date' => $this->distributionDate($data[12]),
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
        $this->command->info('Fruit trees data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Fruit::first();
            $this->command->info("Name: $example->name, Sector: $example->sector");
        }
    }

    public function distributionDate(?string $dateString): ?string
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            // Handle year-only format
            if (preg_match('/^\d{4}$/', $dateString)) {
                return $dateString.'-01-01';
            }

            // Handle DD/MM/YYYY format (European style)
            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dateString)) {
                return Carbon::createFromFormat('d/m/Y', $dateString)->format('Y-m-d');
            }

            // Handle MM/DD/YYYY format (American style)
            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dateString)) {
                return Carbon::createFromFormat('m/d/Y', $dateString)->format('Y-m-d');
            }

            // Try default Carbon parsing for other formats
            return Carbon::parse($dateString)->format('Y-m-d');

        } catch (Exception $e) {
            Log::warning("Could not parse date: '$dateString' - ".$e->getMessage());

            // Return null instead of error message to avoid database constraint violation
            return null;
        }
    }

    private function cleanIdNumber(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        return mb_trim(str_replace(["'", '*'], '', $idNumber));
    }

    private function cleanPhoneNumber(?string $phoneNumber): ?string
    {
        if (empty($phoneNumber)) {
            return null;
        }
        $cleaned = preg_replace('/[^0-9]/', '', $phoneNumber);

        return $cleaned ?: null;
    }
}
