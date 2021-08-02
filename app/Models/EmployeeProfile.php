<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone_number',
        'gender',
        'birthday',
        'description',
        'skill',
        'certification',
        'industry',
        'cover_photo',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class)->as('application')
            ->withPivot('status');
    }
}
