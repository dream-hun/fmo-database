<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Ecd extends Model
{
    protected $guarded = [];

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
