<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_profile_id',
        'school',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'grade',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employeeProfile()
    {
        return $this->belongsTo(EmployeeProfile::class);
    }

    public function setSchoolAttribute($value)
    {
        $this->attributes['school'] = Str::title($value);
    }

    public function setDegreeAttribute($value)
    {
        $this->attributes['degree'] = Str::title($value);
    }

    public function setFieldOfStudyAttribute($value)
    {
        $this->attributes['field_of_study'] = Str::title($value);
    }

    public function setGradeAttribute($value)
    {
        $this->attributes['grade'] = Str::ucfirst($value);
    }
}
