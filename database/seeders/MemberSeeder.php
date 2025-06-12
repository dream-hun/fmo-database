<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Member;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Vsla Members Microcredit data from CSV...');
        $csvPath = database_path('seeders/Data/Members.csv');
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
        DB::table('members')->truncate();
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
                Member::create([
                    'group_id' => $data[0],
                    'name' => $data[1] ?? null,
                    'gender' => mb_ltrim($data[2] ?? '', '*'),
                    'id_number' => $this->cleanIdNumber($data[3] ?? null),
                    'telephone' => $this->cleanPhoneNumber($data[4] ?? ''),
                    'sector' => mb_trim($data[5] ?? null),
                    'cell' => mb_trim($data[6] ?? ''),
                    'village' => mb_trim($data[7] ?? null),

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
        $this->command->info('Members data seeded successfully!');
        $this->command->info("$successCount records imported, $errorCount errors.");

        if ($successCount > 0) {
            $this->command->info('Example of imported data:');
            $example = Member::first();
            $this->command->info("Name: $example->name, Vsla: $example->group->name, Gender: $example->gender");
        }
    }

    protected function cleanPhoneNumber(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        // Remove any non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If it starts with 25, remove it
        if (str_starts_with($phone, '25')) {
            $phone = mb_substr($phone, 2);
        }

        // If it's not 9 or 10 digits, return null
        if (! in_array(mb_strlen($phone), [9, 10])) {
            return null;
        }

        return $phone;
    }

    private function cleanIdNumber(?string $idNumber): ?string
    {
        if (empty($idNumber)) {
            return null;
        }

        return mb_trim(str_replace(["'", '*'], '', $idNumber));
    }
}
