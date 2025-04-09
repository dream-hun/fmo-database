<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public const STATUS_SELECT = [
        '0' => 'Closed',
        '1' => 'In Progress',
    ];

    protected $fillable = [
        'title',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
