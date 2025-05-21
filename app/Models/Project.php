<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Project extends Model
{
    public const STATUS_SELECT = [
        '0' => 'Closed',
        '1' => 'In Progress',
    ];

    public $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
