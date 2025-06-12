<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class SchoolFeeding extends Model
{
    use GenderCountable;

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

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
