<?php

namespace App\Repositories\EmployeeProfile;

use App\Models\EmployeeProfile;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class EmployeeProfileRepository extends Repository implements EmployeeProfileRepositoryInterface
{
    public function getModel()
    {
        return EmployeeProfile::class;
    }

    public function getRecentEmployees()
    {
        return $this
            ->model
            ->whereHas('user', function ($query) {
                $query->where('is_activated', config('user.status.active'));
            })
            ->latest()
            ->take(config('user.num_top_users'))
            ->get();
    }

    public function createJobApplication(int $jobId, array $attributes)
    {
        $profile = Auth::user()->employeeProfile;
        $appliedJob = $profile
            ->jobs()
            ->where('jobs.id', $jobId)
            ->first();
        if ($appliedJob !== null) {
            return false;
        }

        $cvFileName = $this->storeCV($attributes['cv']);

        $profile->jobs()->attach($jobId, [
            'cover_letter' => $attributes['cover_letter'],
            'cv' => $cvFileName,
            'status' => config('user.application_form_status.pending'),
        ]);

        return $this->getJobApplication($profile, $jobId);
    }

    public function updateJobApplication(int $jobId, array $attributes)
    {
        $profile = Auth::user()->employeeProfile;
        $application = $this->getJobApplication($profile, $jobId);
        $cvFileName = $application->cv;

        if (array_key_exists('cv', $attributes)) {
            $cvFileName = $this->storeCV($attributes['cv']);
        }

        $application->update([
            'cover_letter' => $attributes['cover_letter'],
            'cv' => $cvFileName,
        ]);

        return $application;
    }

    public function deleteJobApplication(int $jobId)
    {
        $profile = Auth::user()->employeeProfile;
        $profile->jobs()->detach($jobId);
    }

    public function changeJobApplicationStatus(
        EmployeeProfile $profile,
        int $jobId,
        int $status
    ) {
        $application = $this->getJobApplication($profile, $jobId);
        $application->update(['status' => $status]);

        return $application;
    }

    private function storeCV($file)
    {
        $cvFileName = $this->generateFileName($file);
        $file->move(public_path('images'), $cvFileName);

        return $cvFileName;
    }

    private function generateFileName($file)
    {
        $employeeProfile = Auth::user()->employeeProfile;

        return time() . "{$employeeProfile->name}-{$employeeProfile->id}.{$file->extension()}";
    }

    private function getJobApplication($profile, $jobId)
    {
        return $profile
            ->jobs()
            ->where('jobs.id', $jobId)
            ->firstOrFail()->application;
    }
}
