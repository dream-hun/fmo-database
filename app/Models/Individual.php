<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\GenderCountable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

final class Individual extends Model
{
    use GenderCountable;

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public $table = 'individuals';

    protected array $dates = [
        'loan_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'id_number',
        'business_name',
        'telephone',
        'guardian',
        'guardian_phone',
        'sector',
        'cell',
        'village',
        'loan_amount',
        'loan_date',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getLoanDateAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLoanDateAttribute($value): void
    {
        $this->attributes['loan_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
