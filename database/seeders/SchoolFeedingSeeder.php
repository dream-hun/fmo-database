<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SchoolFeeding;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class SchoolFeedingSeeder extends Seeder
{
    public function run(): void
    {

        $this->command->info('Seeding School Feeding data from CSV...');
        $csvPath = database_path('seeders/Data/SchoolFeeding.csv');
        if (!file_exists($csvPath)) {
            $this->command->error('CSV file not found: ' . $csvPath);
        }

        $file = fopen($csvPath, 'r');
        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Seeding $rowCount School Feeding data from CSV...");
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('school_feedings')->truncate();
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
                SchoolFeeding::create([
                    'uuid' => Str::uuid(),
                    'project_id' => 2,
                    'name' => $data[1],
                    'grade' => $data[2] ?? null,
                    'gender' => $data[3] ?? null,
                    'school_name' => $data[4] ?? null,
                    'district' => $data[5] ?? null,
                    'sector' => $data[6] ?? null,
                    'cell' => $data[7] ?? null,
                    'village' => $data[8] ?? null,
                    'fathers_name' => $data[9] ?? null,
                    'mothers_name' => $data[10] ?? null,
                    'home_phone' => $data[11] ?? null,

                ]);
                $successCount++;
            } catch (Exception $e) {
                $errorCount++;
                if ($errorCount <= 5) {
                    $this->command->error("Error processing row $row: " . $e->getMessage());
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
        $this->command->info('School feeding data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = SchoolFeeding::first();
            $this->command->info("Name: $example->name, School: $example->school_name, Grade: $example->grade");
        }
    }
}
