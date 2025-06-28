<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Permission extends Model
{
    public $table = 'permissions';

    protected array $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',

    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
