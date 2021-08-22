<?php
namespace App\Repositories\Education;

use App\Repositories\RepositoryInterface;

interface EducationRepositoryInterface extends RepositoryInterface
{
    public function getEducationByEmployeeProfile();
}
