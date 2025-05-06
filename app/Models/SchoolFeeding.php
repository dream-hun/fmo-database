<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class SchoolFeeding extends Model
{
    public const GENDER_SELECT = [
        'F' => 'Female',
        'M' => 'Male',
    ];

    public $table = 'school_feedings';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'grade',
        'gender',
        'school_name',
        'district',
        'sector',
        'cell',
        'village',
        'fathers_name',
        'mothers_name',
        'project_id',
        'created_at',
        'updated_at',
        'deleted_at',
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
