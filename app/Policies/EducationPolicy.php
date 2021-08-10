<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Education;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isEmployee();
    }

    public function view(User $user, Education $education)
    {
        return $user->employeeProfile->id === $education->employee_profile_id;
    }

    public function create(User $user)
    {
        return $user->isEmployee();
    }

    public function update(User $user, Education $education)
    {
        return $user->employeeProfile->id === $education->employee_profile_id;
    }

    public function delete(User $user, Education $education)
    {
        return $user->employeeProfile->id === $education->employee_profile_id;
    }
}
