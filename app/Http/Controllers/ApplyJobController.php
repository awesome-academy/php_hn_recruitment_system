<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApplicationFormRequest;

class ApplyJobController extends Controller
{
    public function create($jobId)
    {
        $job = Job::findOrFail($jobId);

        return view('job.application_form', compact('job'));
    }

    public function store(StoreApplicationFormRequest $request, $jobId)
    {
        $employeeProfile = Auth::user()->employeeProfile;
        $appliedJobs = $employeeProfile->jobs;

        foreach ($appliedJobs as $job) {
            if ($job->application->job_id == $jobId) {
                return back()->with('fail', __('messages.apply-fail'));
            }
        }

        $job = Job::findOrFail($jobId);
        $cvFileName = time() . '-' . $employeeProfile->name . '-' .
            $employeeProfile->id . '.' . $request->cv->extension();
        $request->cv->move(public_path('images'), $cvFileName);

        $job->employeeProfiles()->attach($employeeProfile->id, [
            'cover_letter' => $request->cover_letter,
            'cv' => $cvFileName,
            'status' => config('user.application_form_status.pending'),
        ]);

        return redirect()->route('applied_jobs')->with('success', __('messages.apply-success'));
    }

    public function update(StoreApplicationFormRequest $request, $jobId)
    {
        $employeeProfile = Auth::user()->employeeProfile;
        $cvFileName = DB::table('employee_profile_job')
            ->where('job_id', $jobId)->first()->cv;

        if (isset($request->cv)) {
            $cvFileName = time() . '-' . $employeeProfile->name . '-' .
                $employeeProfile->id . '.' . $request->cv->extension();
            $request->cv->move(public_path('images'), $cvFileName);
        }

        $employeeProfile->jobs()->updateExistingPivot($jobId, [
            'cover_letter' => $request->cover_letter,
            'cv' => $cvFileName,
        ]);

        return back()->with('success', __('messages.update-success'));
    }

    public function destroy(Request $request, $jobId)
    {
        $employeeProfile = Auth::user()->employeeProfile;
        $employeeProfile->jobs()->detach($jobId);

        return back()->with('success', __('messages.update-success'));
    }
}
