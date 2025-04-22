<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Vsla extends Model
{
    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public $table = 'vslas';

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

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
