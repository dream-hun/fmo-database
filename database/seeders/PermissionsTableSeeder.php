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
                'title' => 'transaction_create',
            ],
            [
                'id' => 18,
                'title' => 'transaction_edit',
            ],
            [
                'id' => 19,
                'title' => 'transaction_show',
            ],
            [
                'id' => 20,
                'title' => 'transaction_delete',
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
                'title' => 'member_create',
            ],
            [
                'id' => 33,
                'title' => 'member_edit',
            ],
            [
                'id' => 34,
                'title' => 'member_show',
            ],
            [
                'id' => 35,
                'title' => 'member_delete',
            ],
            [
                'id' => 36,
                'title' => 'member_access',
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
                'title' => 'livestock_create',
            ],
            [
                'id' => 54,
                'title' => 'livestock_edit',
            ],
            [
                'id' => 55,
                'title' => 'livestock_show',
            ],
            [
                'id' => 56,
                'title' => 'livestock_delete',
            ],
            [
                'id' => 57,
                'title' => 'livestock_access',
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
            [
                'id' => 74,
                'title' => 'ecd_access',

            ],
            [
                'id' => 75,
                'title' => 'ecd_create',
            ],
            [
                'id' => 76,
                'title' => 'ecd_edit',
            ],
            [
                'id' => 77,
                'title' => 'ecd_show',

            ],
            [
                'id' => 78,
                'title' => 'ecd_delete',
            ],
            [
                'id' => 79,
                'title' => 'urgent_community_access',
            ],
            [
                'id' => 80,
                'title' => 'group_create',
            ],
            [
                'id' => 81,
                'title' => 'group_edit',
            ],
            [
                'id' => 82,
                'title' => 'group_show',
            ],
            [
                'id' => 83,
                'title' => 'group_delete',
            ],
            [
                'id' => 84,
                'title' => 'group_access',
            ],
            [
                'id' => 85,
                'title' => 'urgent_access',
            ],
            [
                'id' => 86,
                'title' => 'urgent_create',
            ],
            [
                'id' => 87,
                'title' => 'urgent_edit',
            ],
            [
                'id' => 88,
                'title' => 'urgent_show',
            ],
            [
                'id' => 89,
                'title' => 'urgent_delete',
            ],
            [
                'id' => 90,
                'title' => 'mvtc_create',
            ],
            [
                'id' => 91,
                'title' => 'mvtc_edit',
            ],
            [
                'id' => 92,
                'title' => 'mvtc_delete',
            ],
            [
                'id' => 93,
                'title' => 'mvtc_access',
            ],
            [
                'id' => 94,
                'title' => 'training_create',
            ],
            [
                'id' => 95,
                'title' => 'training_edit',
            ],
            [
                'id' => 96,
                'title' => 'training_delete',
            ],
            [
                'id' => 97,
                'title' => 'training_access',
            ],
            [
                'id' => 98,
                'title' => 'zamuka_access',
            ],
            [
                'id' => 99,
                'title' => 'zamuka_create',
            ],
            [
                'id' => 100,
                'title' => 'zamuka_edit',
            ],
            [
                'id' => 110,
                'title' => 'zamuka_show',
            ],
            [
                'id' => 111,
                'title' => 'zamuka_delete',
            ],
            [
                'id' => 112,
                'title' => 'empowerment_access',
            ],
            [
                'id' => 113,
                'title' => 'empowerment_create',
            ],
            [
                'id' => 114,
                'title' => 'empowerment_edit',
            ],
            [
                'id' => 115,
                'title' => 'empowerment_show',
            ],
            [
                'id' => 116,
                'title' => 'empowerment_delete',
            ],
            [
                'id' => 117,
                'title' => 'transaction_access',
            ],
            [
                'id' => 118,
                'title' => 'loan_create',
            ],
            [
                'id' => 119,
                'title' => 'loan_edit',
            ],
            [
                'id' => 120,
                'title' => 'loan_show',
            ],
            [
                'id' => 121,
                'title' => 'loan_delete',
            ],
            [
                'id' => 122,
                'title' => 'loan_access',
            ],

        ];

        Permission::insert($permissions);
    }
}
