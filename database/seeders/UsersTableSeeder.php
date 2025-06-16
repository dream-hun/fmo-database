<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->truncate();
        $users = [
            [
                'uuid' => Str::uuid(),
                'name' => 'MBABAZI Jacques',
                'email' => 'support@fmorwanda.org',
                'password' => bcrypt('Imma@1995#'),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'RWAGAJU Desire',
                'email' => 'desire@fmorwanda.org',
                'password' => bcrypt('Fmo@2025#'),
            ],

            [
                'uuid' => Str::uuid(),
                'name' => 'IZABAYO Dieudonne',
                'email' => 'dieudonne@fmorwanda.org',
                'password' => bcrypt('Fmo@2025#'),
            ],

        ];
        User::insert($users);
    }
}
