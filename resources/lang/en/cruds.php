<?php

declare(strict_types=1);

return [
    'userManagement' => [
        'title' => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title' => 'Permissions',
        'title_singular' => 'Permission',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title' => 'Roles',
        'title_singular' => 'Role',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'permissions' => 'Permissions',
            'permissions_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'user' => [
        'title' => 'Users',
        'title_singular' => 'User',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'email' => 'Email',
            'email_helper' => ' ',
            'email_verified_at' => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password' => 'Password',
            'password_helper' => ' ',
            'roles' => 'Roles',
            'roles_helper' => ' ',
            'remember_token' => 'Remember Token',
            'remember_token_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'project' => [
        'title' => 'Projects',
        'title_singular' => 'Project',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'childprotection' => [
        'title' => 'CDSP',
        'title_singular' => 'CDSP',
    ],
    'workForceDevelopment' => [
        'title' => 'WDP',
        'title_singular' => 'WDP',
    ],
    'scholarship' => [
        'title' => 'Scholarship',
        'title_singular' => 'Scholarship',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',

            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'district' => 'District',
            'district_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'email' => 'Email',
            'email_helper' => ' ',
            'school' => 'School',
            'school_helper' => ' ',
            'study_option' => 'Study Option',
            'study_option_helper' => ' ',
            'entrance_year' => 'Entrance Year',
            'entrance_year_helper' => ' ',

            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ], ],
    'vsla' => [
        'title' => 'Vsla Microcredits',
        'title_singular' => 'Vsla Microcredit',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'vlsa' => 'Vlsa',
            'vlsa_helper' => ' ',
            'surname' => 'Surname',
            'surname_helper' => ' ',
            'first_name' => 'First Name',
            'first_name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'project' => 'Project',
            'project_helper' => ' ',
        ],
    ],

    'houseHold' => [
        'title' => 'House Hold Strengthening Program',
        'title_singular' => 'House Hold Strengthening Program',
    ],
    'tank' => [
        'title' => 'Clean Water',
        'title_singular' => 'Clean Water & Sanitation',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Names',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'no_of_tank' => 'No Of Tank',
            'no_of_tank_helper' => ' ',
            'distribution_date' => 'Distribution Date',
            'distribution_date_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'girinka' => [
        'title' => 'One Milky Cow',
        'title_singular' => 'One Milky Cow',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'distribution_date' => 'Distribution Date',
            'distribution_date_helper' => ' ',
            'm_status' => 'Martial Status',
            'm_status_helper' => ' ',
            'pass_over' => 'Pass Over',
            'pass_over_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'comment' => 'Comment',
            'comment_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'project' => 'Project',
            'project_helper' => ' ',
        ],
    ],
    'goat' => [
        'title' => 'Three Goats',
        'title_singular' => 'Three Goat',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'names' => 'Names',
            'names_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'distribution_date' => 'Distribution Date',
            'distribution_date_helper' => ' ',
            'number_of_goats' => 'Number Of Goats',
            'number_of_goats_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'pass_over' => 'Pass Over',
            'pass_over_helper' => ' ',
            'comment' => 'Comment',
            'comment_helper' => ' ',
            'project' => 'Project',
            'project_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'malnutrition' => [
        'title' => 'Malnutrition Control',
        'title_singular' => 'Malnutrition Control',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'age' => 'Age(Months)',
            'age_helper' => ' ',
            'health_center' => 'Health Center',
            'health_center_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'father_name' => 'Father Name',
            'father_name_helper' => ' ',
            'mother_name' => 'Mother Name',
            'mother_name_helper' => ' ',
            'home_phone' => 'Home Phone',
            'home_phone_helper' => ' ',
            'package_reception_date' => 'Package Reception Date',
            'package_reception_date_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'ecd' => [
        'title' => 'ECD',
        'title_singular' => 'ECD',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'grade' => 'Grade',
            'grade_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'academic_year' => 'Academic Year',
            'academic_year_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'father_name' => 'Father Name',
            'father_name_helper' => ' ',
            'mother_name' => 'Mother Name',
            'mother_name_helper' => ' ',
            'home_phone' => 'Home Phone',
            'home_phone_helper' => ' ',

        ],
    ],

    'schoolFeeding' => [
        'title' => 'School Feeding',
        'title_singular' => 'School Feeding',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'grade' => 'Grade',
            'grade_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'school_name' => 'School Name',
            'school_name_helper' => ' ',
            'academic_year' => 'Academic Year',
            'academic_year_helper' => ' ',
            'district' => 'District',
            'district_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'fathers_name' => 'Fathers Name',
            'fathers_name_helper' => ' ',
            'mothers_name' => 'Mothers Name',
            'mothers_name_helper' => ' ',
            'home_phone' => 'Home Phone',
            'home_phone_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'fruit' => [
        'title' => 'Fruit Trees',
        'title_singular' => 'Fruit Tree',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'surname' => 'Surname',
            'surname_helper' => ' ',
            'first_name' => 'First Name',
            'first_name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'national' => 'National',
            'national_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'distribution_date' => 'Distribution Date',
            'distribution_date_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'mangoes' => 'Mangoes',
            'mangoes_helper' => ' ',
            'avocado' => 'Avocado',
            'avocado_helper' => ' ',
            'papaya' => 'Papaya',
            'papaya_helper' => ' ',
            'oranges' => 'Oranges',
            'oranges_helper' => ' ',
            'project' => 'Project',
            'project_helper' => ' ',
        ],
    ],
    'toolkit' => [
        'title' => 'Toolkit',
        'title_singular' => 'Toolkit',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'business_name' => 'Business Name',
            'business_name_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'cohort' => 'Cohort',
            'cohort_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

    'mvtc' => [
        'title' => 'Mvtc',
        'title_singular' => 'Mvtc',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'reg_no' => 'Reg No',
            'reg_no_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'student' => 'Student',
            'student_helper' => ' ',
            'student_contact' => 'Student Contact',
            'student_contact_helper' => ' ',
            'trade' => 'Trade',
            'trade_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'resident_district' => 'Resident District',
            'resident_district_helper' => ' ',
            'education_level' => 'Education Level',
            'education_level_helper' => ' ',
            'payment_mode' => 'Payment Mode',
            'payment_mode_helper' => ' ',
            'intake' => 'Intake',
            'intake_helper' => ' ',
            'graduation_date' => 'Graduation Date',
            'graduation_date_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'training' => [
        'title' => 'Training',
        'title_singular' => 'Training',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'national' => 'National',
            'national_helper' => ' ',
            'district' => 'District',
            'district_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'training_given' => 'Training Given',
            'training_given_helper' => ' ',
            'position' => 'Position',
            'position_helper' => ' ',
            'institution' => 'Institution',
            'institution_helper' => ' ',
            'training_date' => 'Training Date',
            'training_date_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'urgent' => [
        'title' => 'Urgent',
        'title_singular' => 'Urgent',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'phone_number' => 'Phone Number',
            'phone_number_helper' => ' ',
            'support' => 'Support',
            'support_helper' => ' ',
            'support_date' => 'Support Date',
            'support_date_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'empowerment' => [
        'title' => ' ECD Empowerment',
        'title_singular' => 'Empowerment',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'support' => 'Support',
            'support_helper' => ' ',
            'support_date' => 'Support Date',
            'support_date_helper' => ' ',
            'supported_children' => 'Supported Children',
            'supported_children_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'livestock' => [
        'title' => 'Small Livestock',
        'title_singular' => 'Small Livestock',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'distribution_date' => 'Distribution Date',
            'distribution_date_helper' => ' ',
            'type' => 'Type',
            'type_helper' => ' ',
            'number' => 'Number',
            'number_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'zamuka' => [
        'title' => 'Zamuka',
        'title_singular' => 'Zamuka',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'head_of_household_name' => 'Head Of Household Name',
            'head_of_household_name_helper' => ' ',
            'household_id_number' => 'Household Id Number',
            'household_id_number_helper' => ' ',
            'spouse_name' => 'Spouse Name',
            'spouse_name_helper' => ' ',
            'spouse_id_number' => 'Spouse Id Number',
            'spouse_id_number_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'house_hold_phone' => 'House Hold Phone',
            'house_hold_phone_helper' => ' ',
            'family_size' => 'Family Size',
            'family_size_helper' => ' ',
            'entrance_year' => 'Entrance Year',
            'entrance_year_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'group' => [
        'title' => 'VSLA Groups',
        'title_singular' => 'VSLA Group',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'code' => 'Code',
            'code_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'representer' => 'Representer',
            'representer_helper' => ' ',
            'representer_phone' => 'Representer Phone',
            'representer_phone_helper' => ' ',
            'mou_signed_at' => 'Mou Signed At',
            'mou_signed_at_helper' => ' ',
            'number_of_members' => 'Number Of Members',
            'number_of_members_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'member' => [
        'title' => 'VSLA Members',
        'title_singular' => 'VSLA Member',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'group' => 'Group',
            'group_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'transaction' => [
        'title' => 'VSLA Transactions',
        'title_singular' => 'VSLA Transaction',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'group' => 'Group',
            'group_helper' => ' ',
            'member' => 'Member',
            'member_helper' => ' ',
            'amount' => 'Amount',
            'amount_helper' => ' ',
            'done_at' => 'Done At',
            'done_at_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'individual' => [
        'title' => 'Individual',
        'title_singular' => 'Individual',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'id_number' => 'Id Number',
            'id_number_helper' => ' ',
            'telephone' => 'Telephone',
            'telephone_helper' => ' ',
            'sector' => 'Sector',
            'sector_helper' => ' ',
            'cell' => 'Cell',
            'cell_helper' => ' ',
            'village' => 'Village',
            'village_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'loan' => [
        'title' => 'Individual Microcredit',
        'title_singular' => 'Individual Microcredit',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'individual' => 'Individual',
            'individual_helper' => ' ',
            'business_name' => 'Business Name',
            'business_name_helper' => ' ',
            'amount' => 'Amount',
            'amount_helper' => ' ',
            'done_at' => 'Done At',
            'done_at_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

];
