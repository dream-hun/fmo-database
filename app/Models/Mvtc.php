<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Mvtc extends Model
{
    public const GENDER_SELECT = [
        'FEMALE' => 'Female',
        'MALE' => 'Male',
    ];

    public $table = 'mvtcs';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'reg_no',
        'name',
        'gender',
        'student',
        'student_contact',
        'trade',
        'village',
        'cell',
        'sector',
        'resident_district',
        'education_level',
        'payment_mode',
        'intake',
        'graduation_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
