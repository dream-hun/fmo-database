<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Urgent extends Model
{
    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public $table = 'urgents';

    protected array $dates = [
        'support_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'gender',
        'id_number',
        'sector',
        'cell',
        'village',
        'phone_number',
        'support',
        'support_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getSupportDateAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSupportDateAttribute($value): void
    {
        $this->attributes['support_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
