<?php

namespace App\Repositories\EmployerProfile;

use App\Repositories\RepositoryInterface;

interface EmployerProfileRepositoryInterface extends RepositoryInterface
{
    public function getAllIndustries();

    public function getTopCompanies();

    public function getPendingCompanies();
}
