<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Fruit;
use App\Models\Toolkit;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding toolkit data from file...');

        $csvPath = database_path('seeders/Data/Fruit.csv');

        if (! file_exists($csvPath)) {
            $this->command->error("CSV file not found at: {$csvPath}");

            return;
        }

        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file);
        $rowCount = count(file($csvPath)) - 1;
        $this->command->info("Total rows to be inserted: {$rowCount}");

        // Create a progress bar
        $progressBar = $this->command->getOutput()->createProgressBar($rowCount);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();

        // Truncate the table before seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('scholarships')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Process each row
        $row = 0;
        $successCount = 0;
        $errorCount = 0;

        while (($data = fgetcsv($file)) !== false) {
            // Skip header row
            if ($row === 0) {
                $row++;

                continue;
            }

            try {
                // Skip empty rows
                if (empty(mb_trim($data[1] ?? ''))) {
                    $row++;
                    $progressBar->advance();

                    continue;
                }

                // Map CSV data to model fields with proper data cleaning
                Fruit::create([
                    'uuid' => Str::uuid(),
                    'project_id' => 2,
                    'name' => mb_trim($data[0] ?? ''),
                    'gender' => mb_trim($data[1] ?? ''),
                    'id_number' => mb_trim($data[2] ?? ''),
                    'sector' => mb_trim($data[3] ?? ''),
                    'cell' => mb_trim($data[4] ?? ''),
                    'village' => mb_trim($data[5] ?? ''),
                    'mangoes' => mb_trim($data[6] ?? ''),
                    'avocado' => mb_trim($data[7] ?? ''),
                    'papaya' => mb_trim($data[8] ?? ''),
                    'oranges' => mb_trim($data[9] ?? ''),
                    'telephone' => mb_trim($data[10] ?? ''),
                    'distribution_date' => $this->formattedDate($data[11] ?? ''),

                ]);

                $successCount++;
            } catch (Exception $e) {
                $errorCount++;
                if ($errorCount <= 5) {
                    $this->command->error("Error processing row {$row}: ".$e->getMessage());
                } elseif ($errorCount === 6) {
                    $this->command->error('Additional errors exist but are not being displayed...');
                }
            }

            $progressBar->advance();
            $row++;
        }

        // Finish the progress bar
        $progressBar->finish();

        // Close the file
        fclose($file);

        $this->command->newLine(2);
        $this->command->info('Fruit trees data seeded successfully!');
        $this->command->info("{$successCount} records imported, {$errorCount} errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Fruit::first();
            $this->command->info("Name: {$example->name}, Id Number: {$example->id_number}");
        }
    }

    public function formattedDate(string $date): ?string {

        try {
            return  Carbon::createFromFormat('d/m/Y',$date)->format('Y-m-d');
        }catch (Exception $e){
            return null;
        }

    }
}
