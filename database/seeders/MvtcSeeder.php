<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Mvtc;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class MvtcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding MVTC data from CSV...');
        $csvPath = database_path('seeders/Data/Mvtc.csv');

        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);

            return;
        }

        $file = fopen($csvPath, 'r');
        $rowCount = count(file($csvPath)) - 1;

        $this->command->info("Seeding $rowCount MVTC records...");
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('mvtcs')->truncate();
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
                $name = mb_trim($data[2] ?? '');
                if (empty($name)) {
                    $row++;
                    $progressBar->advance();

                    continue;
                }

                Mvtc::create([
                    'reg_no' => $data[1] ?? null,
                    'name' => $name,
                    'gender' => $data[3] ?? null,
                    'student_id' => $this->cleanIdNumber($data[4] ?? null),
                    'student_contact' => $data[5] ?? null,
                    'trade' => $data[6] ?? null,
                    'village' => $data[7] ?? null,
                    'cell' => $data[8] ?? null,
                    'sector' => $data[9] ?? null,
                    'resident_district' => $data[10] ?? null,
                    'education_level' => $data[11] ?? null,
                    'payment_mode' => $data[12] ?? null,
                    'intake' => $data[13] ?? null,
                    'graduation_date' => $data[14] ?? null,

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
            $example = Mvtc::first();
            $this->command->info("Example record — Name: $example->name, Trade: $example->trade, Graduation date: $example->graduation_date");
        }
    }

    /**
     * Clean ID number by removing asterisk prefix.
     */
    private function cleanIdNumber(?string $idNumber): ?string
    {
        return $idNumber ? mb_ltrim($idNumber, '*') : null;
    }
}
