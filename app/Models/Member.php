<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Member extends Model
{
    use GenderCountable;

    public const GENDER_SELECT = [
        'F' => 'Female',
        'M' => 'Male',
    ];

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'group_id',
        'name',
        'gender',
        'id_number',
        'telephone',
        'sector',
        'cell',
        'village',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
