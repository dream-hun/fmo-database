<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    public $table = 'scholarships';

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'surname',
        'first_name',
        'gender',
        'id_number',
        'district',
        'sector',
        'cell',
        'village',
        'telephone',
        'email',
        'school_to_attend',
        'study_option',
        'program_duration',
        'budget_up_to_completion',
        'year_of_entrance',
        'intake',
        'school_contact',
        'project_id',
        'created_at',
        'updated_at',
        'deleted_at',
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
