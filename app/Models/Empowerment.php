<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Empowerment extends Model
{
    public $table = 'empowerments';

    protected array $dates = [
        'support_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'sector',
        'support',
        'support_date',
        'supported_children',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function total()
    {
        return self::sum('supported_children');
    }

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
