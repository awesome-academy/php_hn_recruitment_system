<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Field;
use App\Repositories\EmployerProfile\EmployerProfileRepositoryInterface;
use App\Repositories\Field\FieldRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    protected $employerProfileRepo;
    protected $jobRepo;
    protected $fieldRepo;
    protected $userRepo;

    public function __construct(
        EmployerProfileRepositoryInterface $employerProfileRepo,
        JobRepositoryInterface $jobRepo,
        FieldRepositoryInterface $fieldRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->employerProfileRepo = $employerProfileRepo;
        $this->jobRepo = $jobRepo;
        $this->fieldRepo = $fieldRepo;
        $this->userRepo = $userRepo;
    }

    public function autocompleteJob(Request $request)
    {
        $keyword = $request->terms;
        $data = $this->fieldRepo->searchByName($keyword);
        $data = $data->concat($this->employerProfileRepo->searchByName($keyword));
        $data = $data->concat($this->jobRepo->searchByName($keyword));

        return response()->json($data);
    }

    public function searchJobGeneral(Request $request)
    {
        $keyword = $request->keyword;
        $types = $request->types;

        if ($request->ajax()) {
            $types = explode(',', $types);
            $jobs = $this->jobRepo->searchByType($keyword, $types);
            $cntJobs = $jobs->total();
            $view = view('layouts.job_result', compact('jobs', 'keyword', 'cntJobs'))->render();

            return response()->json(['html' => $view]);
        }
        if (!$types) {
            $jobs = $this->jobRepo->searchByKeyword($keyword);
        } else {
            $types = explode(',', $types);
            $jobs = $this->jobRepo->searchByType($keyword, $types);
        }
        $cntJobs = $jobs->total();

        return view('job.list', compact('keyword', 'jobs', 'cntJobs'));
    }

    public function searchUsers(Request $request)
    {
        $query = $request->get('query');

        return $this->userRepo->searchByName($query);
    }
}
