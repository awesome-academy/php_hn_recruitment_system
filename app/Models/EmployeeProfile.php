<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'skills',
        'certifications',
        'industry',
        'cover_photo',
        'avatar',
    ];

    protected $casts = [
        'birthday' => 'date',
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Str::title($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::ucfirst($value);
    }

    public function setSkillsAttribute($value)
    {
        $this->attributes['skills'] = Str::ucfirst($value);
    }

    public function setCertificationsAttribute($value)
    {
        $this->attributes['certifications'] = Str::ucfirst($value);
    }

    public function setIndustryAttribute($value)
    {
        $this->attributes['industry'] = Str::title($value);
    }
}
