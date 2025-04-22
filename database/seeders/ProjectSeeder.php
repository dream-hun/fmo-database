<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'uuid' => Str::uuid(),
                'title' => 'CDSP',
                'status' => 1,
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'WDP',
                'status' => 1,
            ],
            [
                'uuid' => Str::uuid(),
                'House Hold Strengthen Program',
                'status' => 0,
            ],

        ];
        Project::insert($projects);
    }
}
