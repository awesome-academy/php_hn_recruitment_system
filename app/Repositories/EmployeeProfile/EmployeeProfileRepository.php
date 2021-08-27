<?php

namespace App\Repositories\EmployeeProfile;

use App\Models\EmployeeProfile;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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

        $profile->jobs()->attach($profile->id, [
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
    
    public function getAll()
    {
        return DB::table('employee_profiles')
            ->join('users', 'users.id', '=', 'employee_profiles.user_id')
            ->get();
    }

    public function changeImage(EmployeeProfile $profile, $avatar, $image)
    {
        $fileName = time() . '-' . $profile->id . '.' . $avatar->extension();
        $avatar->move(public_path('images'), $fileName);
        $profile->$image = $fileName;
        $profile->save();
    }

    public function showAppliedJobs()
    {
        return Auth::user()->employeeProfile->jobs;
    }
}
