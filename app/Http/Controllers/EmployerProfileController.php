<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerUpdateRequest;
use App\Models\EmployerProfile;
use App\Repositories\EmployerProfile\EmployerProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmployerProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(EmployerProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

    public function index(Request $request)
    {
        Gate::authorize('is-admin', EmployerProfile::class);
        if ($request->ajax()) {
            $data = $this->profileRepo->getAll();

            return DataTables::of($data)
                ->addColumn('logo', function ($data) {
                    return $this->addLogoColumn($data);
                })
                ->addColumn('status', function ($data) {
                    return $this->addStatusColumn($data);
                })
                ->addColumn('view', function ($data) {
                    return $this->addViewColumn($data);
                })
                ->addColumn('action', function ($data) {
                    return $this->addActionColumn($data);
                })
                ->rawColumns(['logo', 'status', 'view', 'action'])
                ->make(true);
        }

        $industries = $this->profileRepo->getAllIndustries();

        return view('admin.employer', ['industries' => $industries]);
    }

    /**
     * Display the specified employee profile.
     *
     * @param  \App\Models\EmployerProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployerProfile $profile)
    {
        $recentJobs = $profile->recentJobs;

        return view('employer.profile', [
            'profile' => $profile,
            'recentJobs' => $recentJobs,
        ]);
    }

    /**
     * Show the form for editing the specified employee profile.
     *
     * @param  \App\Models\EmployerProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployerProfile $profile)
    {
        $this->authorize('update', $profile);

        return view('employer.edit_profile', ['profile' => $profile]);
    }

    /**
     * Update the specified employee profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployerProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(
        EmployerUpdateRequest $request,
        EmployerProfile $profile
    ) {
        $this->authorize('update', $profile);

        $this->profileRepo->update($profile->id, $request->all());

        return back()->with('success', __('messages.update-success'));
    }

    public function showEmployerJobs(EmployerProfile $profile)
    {
        $jobs = $profile->jobs()->withCount('employeeProfiles')->get();

        return view('employer.jobs', ['jobs' => $jobs]);
    }

    private function addActionColumn($data)
    {
        $button = '';

        if ($data->is_activated == config('user.status.active')) {
            $button .= '<button type="button" id="' . $data->user_id .
                '" class="btn btn-danger btn-outline block-btn" data-toggle="modal" data-target="#modal-sm">'
                . __('messages.block') . '</button>';
        } else {
            $button .= '<button type="button" id="' . $data->user_id .
                '" class="btn btn-warning btn-outline block-btn" data-toggle="modal" data-target="#modal-sm">'
                . __('messages.unblock') . '</button>';
        }

        return $button;
    }

    private function addStatusColumn($data)
    {
        $span = '';

        if ($data->is_activated == config('user.status.active')) {
            $span .= '<span class="badge badge-pill badge-gradient-success">' . __('messages.active') . '</span>';
        } else {
            $span .= '<span class="badge badge-pill badge-gradient-danger">' . __('messages.inactive') . '</span>';
        }

        return $span;
    }

    private function addLogoColumn($data)
    {
        $image = $data->logo ? Storage::url($data->logo) : asset(config('user.default_avt'));

        return '<img height="80" width="80" src="' . $image . '">';
    }

    private function addViewColumn($data)
    {
        $profileURI = route('employer.profiles.show', ['profile' => $data->id]);

        return '<a href="' . $profileURI . '">
            <i class="ti-eye text-info font-weight-bold h3"></i></a>';
    }
}
