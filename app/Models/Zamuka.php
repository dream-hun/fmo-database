<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zamuka extends Model
{


    public $table = 'zamukas';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'head_of_household_name',
        'household_id_number',
        'spouse_name',
        'spouse_id_number',
        'sector',
        'cell',
        'village',
        'house_hold_phone',
        'family_size',
        'entrance_year',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
