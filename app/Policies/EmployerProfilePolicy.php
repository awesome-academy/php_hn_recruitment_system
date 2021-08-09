<?php

namespace App\Policies;

use App\Models\EmployerProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, EmployerProfile $profile)
    {
        return $user->id === $profile->user_id;
    }
}
