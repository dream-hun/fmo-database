<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Scholarship;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

final class ScholarshipImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Scholarship([
            'project_id' => 1,
            'names' => $row['names'],
            'gender' => $row['gender'],
            'id_number' => $row['id_number'],
            'district' => $row['district'],
            'sector' => $row['sector'],
            'cell' => $row['cell'],
            'village' => $row['village'],
            'telephone' => $row['telephone'],
            'email' => $row['email'],
            'school' => $row['school'],
            'study_option' => $row['study_option'],
            'entrance_year' => $row['entrance_year'],
           
        ]);
    }

    public function rules(): array
    {
        return [

        ];
    }
}
