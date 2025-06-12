<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Vsla Members Transactions data from CSV...');
        $csvPath = database_path('seeders/Data/Transactions.csv');
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
        DB::table('transactions')->truncate();
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

                // Create the individual record
                Transaction::create([
                    'member_id' => $data[0] ?? '',
                    'group_id' => $data[1] ?? '',
                    'amount' => $data[2] ?? '',
                    'done_at' => $this->doneAt($data[3] ?? ''),

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
        $this->command->info('Transaction data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Transaction::first();
            $this->command->info("Name: $example->member->name, Vsla: $example->group->name, Gender: $example->member->gender");
        }

    }

    public function doneAt(?string $dateString): ?string
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
}
