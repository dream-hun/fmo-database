<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Malnutrition;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


final class MalnutritionSeeder extends Seeder
{
    public function run(): void
    {

        $this->command->info('Seeding Malnutrition data from CSV...');
        $csvPath = database_path('seeders/Data/Malnutrition.csv');
        if (! file_exists($csvPath)) {
            $this->command->error('CSV file not found: '.$csvPath);
        }

        $file = fopen($csvPath, 'r');
        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Seeding $rowCount Malnutrition data from CSV...");
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('malnutritions')->truncate();
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
                Malnutrition::create([
                    'name' => $data[0],
                    'gender' => $data[1] ?? null,
                    'age' => $data[2] ?? null,
                    'health_center' => $data[3] ?? null,
                    'sector' => $data[4] ?? null,
                    'cell' => $data[5] ?? null,
                    'village' => $data[6] ?? null,
                    'father_name' => $data[7] ?? null,
                    'mother_name' => $data[8] ?? null,
                    'home_phone' => $data[9] ?? null,
                    'package_reception_date'=>$this->receptionDate($data[10]??null),

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
        $this->command->info('Malnutrition data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Malnutrition::first();
            $this->command->info("Name: $example->name, Age: $example->age, Associated health Center: $example->health_center");
        }
    }
    public function  receptionDate(?string $dateString):?string
    {
        if (empty($dateString)) {
            return null;
        }
        try {
            if (preg_match('/^\d{4}$/', $dateString)) {
                return $dateString.'-01-01';

            }
            return Carbon::parse($dateString)->format('Y-m-d');
        }catch (Exception $e) {
            Log::warning('Could not parse date: '.$dateString);
            return $e->getMessage();
        }

    }
}
