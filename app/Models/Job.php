<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getCloseAtAttribute($value)
    {
        $date = new Carbon($value);

        return $date->format('Y-m-d');
    }
}
