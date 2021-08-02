<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function employeeProfile()
    {
        return $this->belongsTo(EmployeeProfile::class);
    }
}
