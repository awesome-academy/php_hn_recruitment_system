<?php

namespace App\Policies;

use App\Models\EmployeeProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeProfilePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isEmployee();
    }

    public function update(User $user, EmployeeProfile $employeeProfile)
    {
        return $user->id === $employeeProfile->user_id;
    }

    public function changeImage(User $user, EmployeeProfile $employeeProfile)
    {
        return $user->id === $employeeProfile->user_id;
    }
}
