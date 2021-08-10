<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Job $job)
    {
        //
    }

    public function create(User $user)
    {
        return $user->isEmployer();
    }

    public function update(User $user, Job $job)
    {
        return $user->employerProfile->id === $job->employer_profile_id;
    }

    public function delete(User $user, Job $job)
    {
        return $user->isAdministrator() || $user->employerProfile->id === $job->employer_profile_id;
    }
}
