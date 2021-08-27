<?php

namespace App\Repositories\EmployeeProfile;

use App\Models\EmployeeProfile;
use App\Repositories\RepositoryInterface;

interface EmployeeProfileRepositoryInterface extends RepositoryInterface
{
    public function getRecentEmployees();

    public function createJobApplication(int $jobId, array $attributes);

    public function updateJobApplication(int $jobId, array $attributes);

    public function deleteJobApplication(int $jobId);

    public function changeJobApplicationStatus(EmployeeProfile $profile, int $jobId, int $status);

    public function changeImage(EmployeeProfile $profile, $avatar, $image);

    public function showAppliedJobs();
}
