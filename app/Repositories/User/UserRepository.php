<?php

namespace App\Repositories\User;

use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getTopUsers()
    {
        return User::where('is_activated', config('user.status.active'))
            ->where('role', config('user.employee'))
            ->orderBy('created_at')->take(config('user.num_top_users'))->get();
    }

    public function changeAccountInfo(User $user, $attributes = [])
    {
        $currentPassword = $attributes['current_password'];
        $newPassword = $attributes['new_password'];
        $user->email = $attributes->email ?? $user->email;
        if ($newPassword !== null) {
            $user->password = Hash::make($newPassword);
            $currentPassword = $newPassword;
        }
        $user->save();

        return $currentPassword;
    }

    public function changeStatus($id)
    {
        $user = $this->find($id);
        $user->is_activated = !$user->is_activated;
        $user->save();
    }

    public function searchByName($keyword)
    {
        if ($keyword !== '') {
            $employees = EmployeeProfile::search($keyword)->get();
            $employers = EmployerProfile::search($keyword)->get();

            return $employers->merge($employees);
        }

        return null;
    }
}
