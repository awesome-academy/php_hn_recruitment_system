<?php

namespace App\Models;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements HasLocalePreference
{
    use HasFactory;
    use Notifiable;

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

    public function preference()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function preferredLocale()
    {
        $preference = $this->preference;

        return $preference !== null
            ? $preference->preferred_locale
            : config('app.locale');
    }

    public function isAdministrator()
    {
        return $this->role === config('user.admin');
    }

    public function isEmployer()
    {
        return $this->role === config('user.employer');
    }

    public function isEmployee()
    {
        return $this->role === config('user.employee');
    }
}
