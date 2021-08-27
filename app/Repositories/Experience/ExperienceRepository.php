<?php

namespace App\Repositories\Experience;

use App\Models\Experience;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class ExperienceRepository extends Repository implements ExperienceRepositoryInterface
{
    public function getModel()
    {
        return Experience::class;
    }

    public function getExperienceByEmployeeProfile()
    {
        return Auth::user()->employeeProfile->experiences;
    }
}
