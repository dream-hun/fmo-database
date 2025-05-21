<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Goat extends Model
{
    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public $table = 'goats';

    protected $dates = [
        'distribution_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'names',
        'id_number',
        'sector',
        'cell',
        'village',
        'distribution_date',
        'number_of_goats',
        'gender',
        'pass_over',
        'comment',
        'project_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getDistributionDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDistributionDateAttribute($value)
    {
        $this->attributes['distribution_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
