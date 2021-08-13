<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $jobs = $this->getRecentJobs();
        $topCompanies = $this->getTopCompanies();
        $topJobs = $this->getTopJobs();
        $recentEmployees = $this->getRecentEmployees();

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

    public function getTopCompanies()
    {
        $topCompanies = DB::table('employer_profiles')
            ->join('users', 'users.id', '=', 'employer_profiles.user_id')
            ->select('employer_profiles.*')
            ->where('users.is_activated', config('user.status.active'))
            ->take(config('user.num_top_companies'))
            ->get();

        return $topCompanies;
    }

    public function getTopJobs()
    {
        $jobs = Job::with('employerProfile')
            ->where('status', config('user.job_status.active'))
            ->orderByDesc('created_at')
            ->take(config('user.num_top_companies'))
            ->get();

        return $jobs;
    }

    public function getRecentJobs()
    {
        $jobs = Job::with('employerProfile')
            ->where('status', config('user.job_status.active'))
            ->orderByDesc('created_at')
            ->paginate(config('user.num_pages'));

        return $jobs;
    }

    public function getPendingCompanies()
    {
        $pendingCompanies = DB::table('employer_profiles')
            ->join('users', 'users.id', '=', 'employer_profiles.user_id')
            ->where('users.is_activated', config('user.status.inactive'))
            ->orderByDesc('employer_profiles.created_at')
            ->take(config('user.num_top_users'))
            ->get();

        return $pendingCompanies;
    }

    public function getRecentEmployees()
    {
        $employees = DB::table('employee_profiles')
            ->join('users', 'users.id', '=', 'employee_profiles.user_id')
            ->select('employee_profiles.*')
            ->where('users.is_activated', config('user.status.active'))
            ->orderByDesc('employee_profiles.created_at')
            ->take(config('user.num_top_users'))
            ->get();

        return $employees;
    }

    public function showAdminDashboard()
    {
        $cntJobs = Job::count();
        $cntCompanies = EmployerProfile::count();
        $cntEmployees = EmployeeProfile::count();
        $pendingCompanies = $this->getPendingCompanies();

        return view('admin.dashboard', compact(
            'cntJobs',
            'cntCompanies',
            'cntEmployees',
            'pendingCompanies'
        ));
    }
}
