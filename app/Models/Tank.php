<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Tank extends Model
{
    public $table = 'tanks';

    protected $dates = [
        'distribution_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'names',
        'gender',
        'id_number',
        'sector',
        'cell',
        'village',
        'no_of_tank',
        'distribution_date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getDistributionDateAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDistributionDateAttribute($value): void
    {
        $this->attributes['distribution_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
