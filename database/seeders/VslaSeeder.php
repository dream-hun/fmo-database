<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Vsla;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class VslaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to seed vsla data from csv file');
        $csvPath = database_path('seeders/Data/Vsla.csv');
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
        DB::table('vslas')->truncate();
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

                Vsla::create([
                    'vsla' => mb_trim($data[1]),
                    'name' => mb_trim($data[2] ?? ''),
                    'gender' => mb_trim($data[3] ?? ''),
                    'id_number' => $this->cleanIdNumber($data[4] ?? ''),
                    'telephone' => $this->cleanPhoneNumber(mb_trim($data[5] ?? '')),
                    'sector' => mb_trim($data[6] ?? ''),
                    'cell' => mb_trim($data[7] ?? ''),
                    'village' => mb_trim($data[8] ?? ''),

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
        $this->command->info('Vsla data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Vsla::first();
            $this->command->info("Name: $example->name, Sector: $example->sector, Vsla: $example->vsla");
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
