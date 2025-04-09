<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Goat extends Model
{
    public $table = 'goats';

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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
}
