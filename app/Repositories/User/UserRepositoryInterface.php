<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getTopUsers();

    public function changeAccountInfo(User $user, $attributes = []);

    public function changeStatus($id);

    public function searchByName($keyword);

    public function getUsersByRole($role);
}
