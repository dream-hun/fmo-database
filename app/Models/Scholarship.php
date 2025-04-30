<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Scholarship extends Model
{
    public const GENDER_SELECT = [
        'F' => 'Female',
        'M' => 'Male',
    ];

    public $table = 'scholarships';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'project_id',
        'names',
        'gender',
        'id_number',
        'district',
        'sector',
        'cell',
        'village',
        'telephone',
        'email',
        'school',
        'study_option',
        'entrance_year',
        'created_at',
        'updated_at',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
