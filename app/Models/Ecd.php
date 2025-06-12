<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Ecd extends Model
{
    use GenderCountable;

    protected $guarded = [];

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
