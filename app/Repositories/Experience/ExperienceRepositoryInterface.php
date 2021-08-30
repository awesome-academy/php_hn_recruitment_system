<?php

namespace App\Repositories\Experience;

use App\Repositories\RepositoryInterface;

interface ExperienceRepositoryInterface extends RepositoryInterface
{
    public function getExperienceByEmployeeProfile();
}
