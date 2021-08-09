<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_profile_id',
        'position',
        'employment_type',
        'start_date',
        'end_date',
        'company',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employeeProfile()
    {
        return $this->belongsTo(EmployeeProfile::class);
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = Str::title($value);
    }

    public function setCompanyAttribute($value)
    {
        $this->attributes['company'] = Str::title($value);
    }
}
