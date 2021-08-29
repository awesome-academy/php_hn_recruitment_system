<?php

namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\Repository;

class JobRepository extends Repository implements JobRepositoryInterface
{
    public function getModel()
    {
        return Job::class;
    }

    public function create($attributes = [])
    {
        $job = parent::create($attributes);
        $job->employer_profile_id = $attributes['employer_profile_id'];
        $job->status = $attributes['status'];
        $job->save();

        return $job;
    }

    public function getTopJobs()
    {
        return $this
            ->model
            ->with('employerProfile')
            ->active()
            ->latest()
            ->take(config('user.num_top_companies'))
            ->get();
    }

    public function getRecentJobs()
    {
        return $this
            ->model
            ->with('employerProfile')
            ->latest()
            ->paginate(config('user.num_pages'));
    }
}
