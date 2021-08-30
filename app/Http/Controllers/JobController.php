<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCreateOrUpdateRequest;
use App\Models\Field;
use App\Models\Job;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
    protected $jobRepo;

    public function __construct(JobRepositoryInterface $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->jobRepo->paginate(config('user.num_pages'));
        $cntJobs = $this->jobRepo->total();

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

        return redirect()
            ->route('employer.jobs', ['profile' => $employerProfile])
            ->with('success', __('messages.update-success'));
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
        $profile = $job->employerProfile;

        return redirect()
            ->route('employer.jobs', ['profile' => $profile])
            ->with('success', __('messages.update-success'));
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

    public function changeStatus(Request $request)
    {
        $jobId = $request->id;
        $job = Job::findOrFail($jobId);
        $job->status = !$job->status;
        $job->save();

        if ($request->ajax()) {
            return __('messages.update-success');
        } else {
            return back()->with('success', __('messages.update-success'));
        }
    }

    public function showCandidates(Job $job)
    {
        $candidates = $job->employeeProfiles;

        return view('job.candidates', [
            'candidates' => $candidates,
            'job' => $job,
        ]);
    }

    public function showManagementForAdmin(Request $request)
    {
        if ($request->ajax()) {
            $jobs = Job::with('employerProfile:id,name')->get();

            return DataTables::of($jobs)
                ->addColumn('status', function ($data) {
                    return $this->createStatusColumn($data);
                })
                ->addColumn('actions', function ($data) {
                    return $this->createActionColumn($data);
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.jobs');
    }

    private function createStatusColumn($data)
    {
        switch ($data->status) {
            case config('user.job_status.active'):
                $status = __('messages.active');
                $htmlClass = 'badge-gradient-success';
                break;
            case config('user.job_status.hidden'):
                $status = __('messages.hidden');
                $htmlClass = 'badge-gradient-danger';
                break;
            default:
                $status = '';
                $htmlClass = '';
        }

        return <<<HTML
            <span class="badge badge-pill $htmlClass">$status</span>
        HTML;
    }

    private function createActionColumn($data)
    {
        $viewJobUrl = route('jobs.show', ['job' => $data]);
        $deleteJobUrl = route('jobs.destroy', ['job' => $data]);
        $viewHint = __('messages.view');
        $deleteHint = __('messages.delete');

        return <<<HTML
            <div class="action-job">
                <button
                    id="delete"
                    value="$deleteJobUrl"
                    class="action unstyled cursor-pointer"
                    data-toggle="modal"
                    data-target="#modal-sm"
                >
                    <span class="hint">$deleteHint</span>
                    <i class="ti-trash"></i>
                </button>
                <a class="action" href="$viewJobUrl">
                    <span class="hint">$viewHint</span>
                    <i class="ti-eye"></i>
                </a>
            </div>
        HTML;
    }
}
