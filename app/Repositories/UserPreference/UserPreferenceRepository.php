<?php

namespace App\Repositories\UserPreference;

use App\Models\UserPreference;
use App\Repositories\Repository;

class UserPreferenceRepository extends Repository implements UserPreferenceRepositoryInterface
{
    public function getModel()
    {
        return UserPreference::class;
    }

    public function updateOrCreate($attributes = [])
    {
        $userId = $attributes['user_id'];
        $preference = $this->model->firstOrNew(['user_id' => $userId]);
        $preference->user_id = $userId;
        $preference->update($attributes);
        $preference->save();

        return $preference;
    }
}
