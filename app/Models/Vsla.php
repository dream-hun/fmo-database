<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Vsla extends Model
{
    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public $table = 'vslas';

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [

        'vlsa',
        'name',
        'gender',
        'id_number',
        'telephone',
        'sector',
        'cell',
        'village',
        'created_at',
        'updated_at',

    ];


    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
