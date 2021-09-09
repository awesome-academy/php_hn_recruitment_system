<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Repositories\EmployeeProfile\EmployeeProfileRepositoryInterface;
use App\Repositories\EmployerProfile\EmployerProfileRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $employeeProfileRepo;

    private $employerProfileRepo;

    private $jobRepo;

    public function __construct(
        EmployeeProfileRepositoryInterface $employeeProfileRepo,
        EmployerProfileRepositoryInterface $employerProfileRepo,
        JobRepositoryInterface $jobRepo
    ) {
        $this->employeeProfileRepo = $employeeProfileRepo;
        $this->employerProfileRepo = $employerProfileRepo;
        $this->jobRepo = $jobRepo;
    }

    public function index(Request $request)
    {
        $jobs = $this->jobRepo->getRecentJobs();
        $topCompanies = $this->employerProfileRepo->getTopCompanies();
        $topJobs = $this->jobRepo->getTopJobs();
        $recentEmployees = $this->employeeProfileRepo->getRecentEmployees();

        if ($request->ajax()) {
            $view = view('layouts.job_data', compact('jobs'))->render();

            return response()->json(['html' => $view]);
        }

        return view('welcome', compact('jobs', 'topCompanies', 'topJobs', 'recentEmployees'));
    }

    public function changeLanguage(Request $request, $locale)
    {
        if ($locale && in_array($locale, config('app.languages'))) {
            $request->session()->put('language', $locale);
        }

        return redirect()->back();
    }

    public function showInactive()
    {
        return view('inactive');
    }

    public function showAdminDashboard()
    {
        $cntJobs = $this->jobRepo->total();
        $cntCompanies = $this->employerProfileRepo->total();
        $cntEmployees = $this->employeeProfileRepo->total();
        $pendingCompanies = $this->employerProfileRepo->getPendingCompanies();

        return view('admin.dashboard', compact(
            'cntJobs',
            'cntCompanies',
            'cntEmployees',
            'pendingCompanies'
        ));
    }

    public function getJobStatistics()
    {
        return view('admin.statistic');
    }

    public function getMonthlyJobData()
    {
        $jobCount = [];
        $monthNames = [];
        $months = $this->jobRepo->getAllMonths();

        if (!empty($months)) {
            foreach ($months as $monthNo => $monthName) {
                $jobCount[] = $this->jobRepo->getMonthlyJobCount($monthNo);
                $monthNames[] = $monthName;
            }
        }

        return [
            'months' => $monthNames,
            'jobCount' => $jobCount,
        ];
    }

    public function getJobTypeData()
    {
        $types = $this->jobRepo->getJobTypes();
        $activeCount = [];
        $inactiveCount = [];
        foreach ($types as $type) {
            $activeCount[] = $this->jobRepo->getJobTypeCount($type, config('user.job_status.active'));
            $inactiveCount[] = $this->jobRepo->getJobTypeCount($type, config('user.job_status.hidden'));
        }

        return [
            'types' => $types,
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
        ];
    }

    public function getAppliedData($jobId)
    {
        $status = config('user.application_form_status');
        $appliedStatus = [];
        foreach ($status as $key => $value) {
            $appliedStatus[] = $key;
        }
        $appliedCnt = $this->jobRepo->getAppliedData($jobId);

        return [
            'appliedStatus' => $appliedStatus,
            'appliedCnt' => $appliedCnt,
        ];
    }
}
