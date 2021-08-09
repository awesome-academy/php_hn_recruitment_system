<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_profile_id',
        'field_id',
        'title',
        'description',
        'location',
        'job_type',
        'quantity',
        'salary',
        'requirement',
        'benefit',
        'image',
        'status',
        'started_at',
        'closed_at',
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
            ->withPivot('status', 'created_at', 'updated_at');
    }
}
