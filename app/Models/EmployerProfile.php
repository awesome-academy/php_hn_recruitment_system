<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class EmployerProfile extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'website',
        'address',
        'phone_number',
        'company_size',
        'company_type',
        'description',
        'industry',
        'cover_photo',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function recentJobs()
    {
        return $this->jobs()
            ->orderBy('created_at', 'desc')
            ->limit(config('user.num_top_recent_jobs'));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setIndustryAttribute($value)
    {
        $this->attributes['industry'] = Str::title($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::ucfirst($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Str::title($value);
    }
}
