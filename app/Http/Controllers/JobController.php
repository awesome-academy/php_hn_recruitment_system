<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCreateOrUpdateRequest;
use App\Models\Field;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::paginate(config('user.num_pages'));
        $cntJobs = Job::count();

        return view('job.list', [
            'jobs' => $jobs,
            'cntJobs' => $cntJobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::all();
        $jobTypes = config('user.job_type');

        return view('job.create', [
            'fields' => $fields,
            'jobTypes' => $jobTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCreateOrUpdateRequest $request)
    {
        $user = Auth::user();
        $employerProfile = $user->employerProfile;
        $job = new Job($request->all());
        $job->employer_profile_id = $employerProfile->id;
        $job->status = config('user.job_status.active');
        $job->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);

        return view('job.detail', [
            'job' => $job,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $fields = Field::all();
        $jobTypes = config('user.job_type');

        return view('job.edit', [
            'job' => $job,
            'fields' => $fields,
            'jobTypes' => $jobTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobCreateOrUpdateRequest $request, Job $job)
    {
        $job->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return back();
    }

    public function hide(Job $job)
    {
        $job->update([
            'status' => config('user.job_status.hidden'),
        ]);

        return back();
    }
}
