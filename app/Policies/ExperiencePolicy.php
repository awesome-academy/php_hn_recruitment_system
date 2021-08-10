<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperiencePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isEmployee();
    }

    public function view(User $user, Experience $experience)
    {
        return $user->employeeProfile->id === $experience->employee_profile_id;
    }

    public function create(User $user)
    {
        return $user->isEmployee();
    }

    public function update(User $user, Experience $experience)
    {
        return $user->employeeProfile->id === $experience->employee_profile_id;
    }

    public function delete(User $user, Experience $experience)
    {
        return $user->employeeProfile->id === $experience->employee_profile_id;
    }
}
