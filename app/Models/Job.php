<?php

namespace App\Models;

use Carbon\Carbon;
use Akaunting\Money\Money;
use Illuminate\Support\Str;
use Akaunting\Money\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'title',
        'description',
        'location',
        'contact_email',
        'job_type',
        'quantity',
        'salary',
        'requirement',
        'benefit',
        'image',
        'status',
        'close_at',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function employerProfile()
    {
        return $this->belongsTo(EmployerProfile::class);
    }

    public function employeeProfiles()
    {
        return $this->belongsToMany(EmployeeProfile::class)->as('application')
            ->withPivot('job_id', 'status', 'created_at', 'updated_at', 'cover_letter', 'cv');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCloseAtAttribute($value)
    {
        $date = new Carbon($value);

        return $date->format('Y-m-d');
    }

    public function getSalaryAttribute($value)
    {
        return Money::USD($value, true);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::ucfirst($value);
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = Str::title($value);
    }

    public function setRequirementAttribute($value)
    {
        $this->attributes['requirement'] = Str::ucfirst($value);
    }

    public function setBenefitAttribute($value)
    {
        $this->attributes['benefit'] = Str::ucfirst($value);
    }
}
