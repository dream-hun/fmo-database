<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class SchoolFeeding extends Model
{
    use GenderCountable;

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public $table = 'school_feedings';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'grade',
        'gender',
        'school_name',
        'academic_year',
        'district',
        'sector',
        'cell',
        'village',
        'fathers_name',
        'mothers_name',
        'home_phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
