<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Malnutrition extends Model
{
    protected $table = 'malnutritions';

    protected $fillable = [
        'surname',
        'first_name',
        'gender',
        'age',
        'health_center',
        'sector',
        'cell',
        'village',
        'father_name',
        'mother_name',
        'home_phone',
        'package_reception_date',
        'entry_muac',
        'currently_muac',
        'current_malnutrition_code',
    ];
}
