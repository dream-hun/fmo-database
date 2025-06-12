<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Loan extends Model
{
    public $table = 'loans';

    protected array $dates = [
        'done_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'individual_id',
        'business_name',
        'amount',
        'done_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function individual(): BelongsTo
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function getDoneAtAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDoneAtAttribute($value): void
    {
        $this->attributes['done_at'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
