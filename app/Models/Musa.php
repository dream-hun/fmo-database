<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Musa extends Model
{
    protected $fillable = [
        'name',
        'id_number',
        'family_members',
        'support_given',
        'support_date',
        'sector',
        'cell',
        'village',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
