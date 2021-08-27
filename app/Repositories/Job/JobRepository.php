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

    public function searchByName($keyword)
    {
        return Job::select('title as name')
            ->where('title', 'like', "%{$keyword}%")->get();
    }

    public function searchByType($keyword, $types)
    {
        return Job::select('jobs.*')
            ->join('fields', 'fields.id', '=', 'jobs.field_id')
            ->join('employer_profiles', 'employer_profiles.id', '=', 'jobs.employer_profile_id')
            ->whereIn('job_type', $types)
            ->where(function ($query) use ($keyword) {
                $query->where('fields.name', 'like', "%{$keyword}%")
                    ->orWhere('employer_profiles.name', 'like', "%{$keyword}%")
                    ->orWhere('jobs.title', 'like', "%{$keyword}%");
            })->paginate(config('user.num_pages'))->withQueryString();
    }

    public function searchByKeyword($keyword)
    {
        return Job::select('jobs.*')
            ->join('fields', 'fields.id', '=', 'jobs.field_id')
            ->join('employer_profiles', 'employer_profiles.id', '=', 'jobs.employer_profile_id')
            ->where('fields.name', 'like', "%{$keyword}%")
            ->orWhere('employer_profiles.name', 'like', "%{$keyword}%")
            ->orWhere('jobs.title', 'like', "%{$keyword}%")
            ->paginate(config('user.num_pages'))->withQueryString();
    }
}
