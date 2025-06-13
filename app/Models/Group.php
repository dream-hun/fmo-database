<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Group extends Model
{
    protected array $dates = [
        'mou_signed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'name',
        'representer',
        'representer_phone',
        'mou_signed_at',
        'number_of_members',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);

    }

    public function getMouSignedAtAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMouSignedAtAttribute($value): void
    {
        $this->attributes['mou_signed_at'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
