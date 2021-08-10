<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
        'is_activated',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employeeProfile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    public function employerProfile()
    {
        return $this->hasOne(EmployerProfile::class);
    }

    public function isAdministrator()
    {
        return Auth::user()->role === config('user.admin');
    }

    public function isEmployer()
    {
        return Auth::user()->role === config('user.employer');
    }

    public function isEmployee()
    {
        return Auth::user()->role === config('user.employee');
    }
}
