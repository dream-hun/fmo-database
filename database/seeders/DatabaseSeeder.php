<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProjectSeeder::class,
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
            GoatSeeder::class,
            GirinkaSeeder::class,
            VslaSeeder::class,
            TankSeeder::class,
            IndividualSeeder::class,
            MalnutritionSeeder::class,
            ScholarshipSeeder::class,
            SchoolFeedingSeeder::class,
            FruitSeeder::class,
            ToolkitSeeder::class,
        ]);

    }
}
