<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Fruit extends Model
{
    public $table = 'fruits';

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'surname',
        'first_name',
        'gender',
        'national',
        'sector',
        'cell',
        'village',
        'mangoes',
        'avocado',
        'papaya',
        'oranges',
        'telephone',
        'distribution_date',
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
