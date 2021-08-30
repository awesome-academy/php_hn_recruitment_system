<?php

namespace App\Http\Controllers;

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
}
