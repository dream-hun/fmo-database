<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Role extends Model
{
    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',

    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
