<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
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
                'WDP',
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
