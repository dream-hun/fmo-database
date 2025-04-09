<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Girinka extends Model
{
    public $table = 'girinkas';

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    protected $dates = [
        'distribution_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'names',
        'gender',
        'id_number',
        'sector',
        'village',
        'cell',
        'distribution_date',
        'm_status',
        'pass_over',
        'telephone',
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
