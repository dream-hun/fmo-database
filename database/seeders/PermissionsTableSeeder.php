<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

final class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'title' => 'user_management_access',
            ],
            [
                'id' => 2,
                'title' => 'permission_create',
            ],
            [
                'id' => 3,
                'title' => 'permission_edit',
            ],
            [
                'id' => 4,
                'title' => 'permission_show',
            ],
            [
                'id' => 5,
                'title' => 'permission_delete',
            ],
            [
                'id' => 6,
                'title' => 'permission_access',
            ],
            [
                'id' => 7,
                'title' => 'role_create',
            ],
            [
                'id' => 8,
                'title' => 'role_edit',
            ],
            [
                'id' => 9,
                'title' => 'role_show',
            ],
            [
                'id' => 10,
                'title' => 'role_delete',
            ],
            [
                'id' => 11,
                'title' => 'role_access',
            ],
            [
                'id' => 12,
                'title' => 'user_create',
            ],
            [
                'id' => 13,
                'title' => 'user_edit',
            ],
            [
                'id' => 14,
                'title' => 'user_show',
            ],
            [
                'id' => 15,
                'title' => 'user_delete',
            ],
            [
                'id' => 16,
                'title' => 'user_access',
            ],
            [
                'id' => 17,
                'title' => 'project_create',
            ],
            [
                'id' => 18,
                'title' => 'project_edit',
            ],
            [
                'id' => 19,
                'title' => 'project_delete',
            ],
            [
                'id' => 20,
                'title' => 'project_access',
            ],
            [
                'id' => 21,
                'title' => 'malnutrition_create',
            ],
            [
                'id' => 22,
                'title' => 'malnutrition_edit',
            ],
            [
                'id' => 23,
                'title' => 'malnutrition_delete',
            ],
            [
                'id' => 24,
                'title' => 'malnutrition_access',
            ],
            [
                'id' => 25,
                'title' => 'childprotection_access',
            ],
            [
                'id' => 26,
                'title' => 'work_force_development_access',
            ],
            [
                'id' => 27,
                'title' => 'scholarship_create',
            ],
            [
                'id' => 28,
                'title' => 'scholarship_edit',
            ],
            [
                'id' => 29,
                'title' => 'scholarship_show',
            ],
            [
                'id' => 30,
                'title' => 'scholarship_delete',
            ],
            [
                'id' => 31,
                'title' => 'scholarship_access',
            ],
            [
                'id' => 32,
                'title' => 'vsla_create',
            ],
            [
                'id' => 33,
                'title' => 'vsla_edit',
            ],
            [
                'id' => 34,
                'title' => 'vsla_show',
            ],
            [
                'id' => 35,
                'title' => 'vsla_delete',
            ],
            [
                'id' => 36,
                'title' => 'vsla_access',
            ],
            [
                'id' => 37,
                'title' => 'individual_create',
            ],
            [
                'id' => 38,
                'title' => 'individual_edit',
            ],
            [
                'id' => 39,
                'title' => 'individual_show',
            ],
            [
                'id' => 40,
                'title' => 'individual_delete',
            ],
            [
                'id' => 41,
                'title' => 'individual_access',
            ],
            [
                'id' => 42,
                'title' => 'house_hold_access',
            ],
            [
                'id' => 43,
                'title' => 'tank_create',
            ],
            [
                'id' => 44,
                'title' => 'tank_edit',
            ],
            [
                'id' => 45,
                'title' => 'tank_show',
            ],
            [
                'id' => 46,
                'title' => 'tank_delete',
            ],
            [
                'id' => 47,
                'title' => 'tank_access',
            ],
            [
                'id' => 48,
                'title' => 'girinka_create',
            ],
            [
                'id' => 49,
                'title' => 'girinka_edit',
            ],
            [
                'id' => 50,
                'title' => 'girinka_show',
            ],
            [
                'id' => 51,
                'title' => 'girinka_delete',
            ],
            [
                'id' => 52,
                'title' => 'girinka_access',
            ],
            [
                'id' => 53,
                'title' => 'goat_create',
            ],
            [
                'id' => 54,
                'title' => 'goat_edit',
            ],
            [
                'id' => 55,
                'title' => 'goat_show',
            ],
            [
                'id' => 56,
                'title' => 'goat_delete',
            ],
            [
                'id' => 57,
                'title' => 'goat_access',
            ],
            [
                'id' => 58,
                'title' => 'profile_password_edit',
            ],
            [
                'id' => 59,
                'title' => 'school_feeding_create',
            ],
            [
                'id' => 60,
                'title' => 'school_feeding_edit',
            ],
            [
                'id' => 61,
                'title' => 'school_feeding_show',
            ],
            [
                'id' => 62,
                'title' => 'school_feeding_delete',
            ],
            [
                'id' => 63,
                'title' => 'school_feeding_access',
            ],
            [
                'id' => 64,
                'title' => 'school_feeding_access',
            ],
            [
                'id' => 65,
                'title' => 'fruit_create',
            ],
            [
                'id' => 66,
                'title' => 'fruit_edit',
            ],
            [
                'id' => 67,
                'title' => 'fruit_delete',
            ],
            [
                'id' => 68,
                'title' => 'fruit_access',
            ],
            [
                'id' => 69,
                'title' => 'toolkit_access',
            ],
            [
                'id' => 70,
                'title' => 'toolkit_create',
            ],
            [
                'id' => 71,
                'title' => 'toolkit_edit',
            ],
            [
                'id' => 72,
                'title' => 'toolkit_show',
            ],
            [
                'id' => 73,
                'title' => 'toolkit_delete',
            ],
        ];

        Permission::insert($permissions);
    }
}
