<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class RoleUserTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('role_user')->truncate();
        $adminRoleId = 1;
        $adminUserIds = [1, 2, 3];

        foreach ($adminUserIds as $userId) {
            User::findOrFail($userId)->roles()->sync($adminRoleId);
        }
    }
}
