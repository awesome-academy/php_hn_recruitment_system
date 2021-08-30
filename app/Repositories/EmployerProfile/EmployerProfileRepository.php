<?php

namespace App\Repositories\EmployerProfile;

use App\Models\EmployerProfile;
use App\Repositories\Repository;

class EmployerProfileRepository extends Repository implements EmployerProfileRepositoryInterface
{
    public function getModel()
    {
        return EmployerProfile::class;
    }

    public function getAll()
    {
        return $this
            ->model
            ->join('users', 'users.id', '=', 'employer_profiles.user_id')
            ->get();
    }

    public function update($id, $attributes = [])
    {
        $this->storeImageAttributes($attributes, 'logo');
        $this->storeImageAttributes($attributes, 'cover_photo');

        return parent::update($id, $attributes);
    }

    private function storeImageAttributes(&$attributes, $attributeName)
    {
        if (array_key_exists($attributeName, $attributes)) {
            $uploadedImage = $attributes[$attributeName];
            $imagePath = $uploadedImage->storePublicly('public/images');
            $attributes[$attributeName] = $imagePath;
        }
    }

    public function getAllIndustries()
    {
        return $this
            ->model
            ->select('industry')
            ->distinct()
            ->pluck('industry')
            ->toArray();
    }

    public function getTopCompanies()
    {
        return $this
            ->model
            ->whereHas('user', function ($query) {
                $query->where('is_activated', config('user.status.active'));
            })
            ->take(config('user.num_top_companies'))
            ->get();
    }

    public function getPendingCompanies()
    {
        return $this
            ->model
            ->whereHas('user', function ($query) {
                $query->where('is_activated', config('user.status.inactive'));
            })
            ->latest()
            ->take(config('user.num_top_users'))
            ->get();
    }
}
