<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Toolkit extends Model
{
    use GenderCountable;

    public const GENDER_SELECT = [
        'F' => 'Female',
        'M' => 'Male',
    ];

    public $table = 'toolkits';

    protected array $dates = [
        'cohort',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'gender',
        'id_number',
        'business_name',
        'telephone',
        'sector',
        'cell',
        'village',
        'cohort',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getCohortAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCohortAttribute($value): void
    {
        $this->attributes['cohort'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
