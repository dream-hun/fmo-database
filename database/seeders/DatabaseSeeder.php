<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
            GirinkaSeeder::class,
            TankSeeder::class,
            IndividualSeeder::class,
            MalnutritionSeeder::class,
            ScholarshipSeeder::class,
            SchoolFeedingSeeder::class,
            FruitSeeder::class,
            ToolkitSeeder::class,
            EcdSeeder::class,
            UrgentSeeder::class,
            MvtcSeeder::class,
            TrainingSeeder::class,
            EmpowermentSeeder::class,
            ZamukaSeeder::class,
            LivestockSeeder::class,
            GroupSeeder::class,
            MemberSeeder::class,
            TransactionSeeder::class,
        ]);

    }
}
