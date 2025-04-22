<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Malnutrition extends Model
{
    public const CURRENT_MALNUTRITION_CODE_SELECT = [
        'yellow' => 'Yellow',
        'green' => 'Green',
        'red' => 'Red',
    ];

    public $table = 'malnutritions';

    protected array $dates = [
        'package_reception_date',
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'project_id',
        'surname',
        'first_name',
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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

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
