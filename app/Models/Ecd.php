<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Ecd extends Model
{
    use GenderCountable;

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public const GRADE_SELECT = [
        'Top' => 'Top',
        'Middle' => 'Middle',
        'Baby' => 'Baby',
    ];

    public $table = 'ecds';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'grade',
        'gender',
        'academic_year',
        'sector',
        'cell',
        'village',
        'father_name',
        'mother_name',
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
