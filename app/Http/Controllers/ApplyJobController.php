<?php

namespace App\Http\Controllers;

use App\Events\JobApplicationStatusChanged;
use App\Http\Requests\ChangeJobApplicationStatusRequest;
use App\Http\Requests\StoreApplicationFormRequest;
use App\Models\EmployeeProfile;
use App\Repositories\EmployeeProfile\EmployeeProfileRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApplyJobController extends Controller
{
    private $jobRepo;
    private $employeeProfileRepo;

    public function __construct(
        JobRepositoryInterface $jobRepo,
        EmployeeProfileRepositoryInterface $employeeProfileRepo
    ) {
        $this->jobRepo = $jobRepo;
        $this->employeeProfileRepo = $employeeProfileRepo;
    }

    public function create($jobId)
    {
        $job = $this->jobRepo->find($jobId);

        return view('job.application_form', compact('job'));
    }

    public function store(StoreApplicationFormRequest $request, $jobId)
    {
        if ($this->employeeProfileRepo->createJobApplication($jobId, $request->all())) {
            return redirect()
                ->route('applied_jobs')
                ->with('success', __('messages.apply-success'));
        }

        return back()->with('fail', __('messages.apply-fail'));
    }

    public function update(StoreApplicationFormRequest $request, $jobId)
    {
        $this->employeeProfileRepo->updateJobApplication($jobId, $request->all());

        return back()->with('success', __('messages.update-success'));
    }

    public function destroy($jobId)
    {
        $this->employeeProfileRepo->deleteJobApplication($jobId);

        return back()->with('success', __('messages.update-success'));
    }

    public function changeStatus(
        ChangeJobApplicationStatusRequest $request,
        EmployeeProfile $employeeProfile
    ) {
        $jobId = $request->jobId;
        $job = $this->jobRepo->find($jobId);
        Gate::authorize('check-job-owner', $job);

        $this->employeeProfileRepo->changeJobApplicationStatus(
            $employeeProfile,
            $jobId,
            $request->status
        );

        // Handler: App\Listeners\SendJobApplicationApprovalEmail;
        event(new JobApplicationStatusChanged(
            $employeeProfile,
            Auth::user()->employerProfile,
            $job,
            $request->status
        ));

        return back()->with('success', __('messages.update-success'));
    }
}
