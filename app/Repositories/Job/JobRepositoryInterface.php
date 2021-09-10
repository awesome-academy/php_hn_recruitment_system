<?php

namespace App\Repositories\Job;

use App\Repositories\RepositoryInterface;

interface JobRepositoryInterface extends RepositoryInterface
{
    public function getTopJobs();

    public function getRecentJobs();

    public function searchByName($keyword);

    public function searchByType($keyword, $types);

    public function searchByKeyword($keyword);

    public function getAllMonths();

    public function getMonthlyJobCount($month);

    public function getJobTypes();

    public function getJobTypeCount($type, $status);

    public function getAppliedData($jobId);
}
