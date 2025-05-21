<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Toolkit extends Model
{
    protected $fillable = [
        'uuid',
        'project_id',
        'name',
        'gender',
        'identification_number',
        'phone_number',
        'tvet_attended',
        'option',
        'level',
        'training_intake',
        'reception_date',
        'toolkit_received',
        'toolkit_cost',

        'sector',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
