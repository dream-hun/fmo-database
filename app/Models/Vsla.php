<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Vsla extends Model
{
    public $table = 'vslas';

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'project_id',
        'vlsa',
        'surname',
        'first_name',
        'gender',
        'id_number',
        'telephone',
        'sector',
        'cell',
        'village',
        'created_at',
        'updated_at',

    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
