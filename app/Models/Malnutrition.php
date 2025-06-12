<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Malnutrition extends Model
{
    use GenderCountable;

    public const GENDER_SELECT = [
        'F' => 'Female',
        'M' => 'Male',
    ];

    public $table = 'malnutritions';

    protected array $dates = [
        'package_reception_date',
        'created_at',
        'updated_at',

    ];

    protected $fillable = [

        'name',
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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getPackageReceptionDateAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPackageReceptionDateAttribute($value): void
    {
        $this->attributes['package_reception_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
