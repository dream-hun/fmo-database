<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Zamuka;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class ZamukaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to Seed Zamuka Data from CSV file');
        $csvPath = database_path('/seeders/Data/Zamuka.csv');
        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);
        }

        $file = fopen($csvPath, 'r');
        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Seeding $rowCount Zamuka Data from CSV...");
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('zamukas')->truncate();
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
                if (empty(mb_trim($data[0] ?? ''))) {
                    $row++;
                    $progressBar->advance();

                    continue;
                }
                Zamuka::create([

                    'head_of_household_name' => $data[0],
                    'household_id_number' => $data[1] ?? null,
                    'spouse_name' => $data[2] ?? null,
                    'spouse_id_number' => ($data[3] ?? null),
                    'sector' => $data[4] ?? null,
                    'cell' => $data[5] ?? null,
                    'village' => $data[6] ?? null,
                    'family_size' => ! empty(mb_trim($data[7] ?? '')) ? (int) $data[7] : null,
                    'entrance_year' => ! empty(mb_trim($data[8] ?? '')) ? $data[8] : null,

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
        $this->command->info('Zamuka data  seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Zamuka::first();
            $this->command->info("Name: $example->name, Sector: $example->sector");
        }
    }
}
