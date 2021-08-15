<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function employeeProfile()
    {
        return $this->hasOneThrough(
            EmployeeProfile::class,
            User::class,
            'id',
            'user_id',
            'user_id',
            'id',
        );
    }

    public function employerProfile()
    {
        return $this->hasOneThrough(
            EmployerProfile::class,
            User::class,
            'id',
            'user_id',
            'user_id',
            'id',
        );
    }
}
