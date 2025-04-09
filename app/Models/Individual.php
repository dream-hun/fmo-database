<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    public $table = 'individuals';

    public const GENDER_SELECT = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    protected $dates = [
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getLoanDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLoanDateAttribute($value)
    {
        $this->attributes['loan_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
