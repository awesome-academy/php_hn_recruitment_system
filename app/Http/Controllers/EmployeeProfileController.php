<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateEmployeeProfileRequest;

class EmployeeProfileController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('is-admin', EmployeeProfile::class);
        if ($request->ajax()) {
            $data = DB::table('employee_profiles')
                ->join('users', 'users.id', '=', 'employee_profiles.user_id')
                ->get();

            return DataTables::of($data)
                ->addColumn('avatar', function ($data) {
                    return $this->addAvatarColumn($data);
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
                ->rawColumns(['avatar', 'status', 'view', 'action'])
                ->make(true);
        }

        return view('admin.employee');
    }

    public function show(EmployeeProfile $employeeProfile)
    {
        $educationList = $employeeProfile->education;
        $experienceList = $employeeProfile->experiences;
        $userList = User::where('is_activated', config('user.status.active'))
            ->where('role', config('user.employee'))
            ->orderBy('created_at')->take(config('user.num_top_users'))->get();

        return view('employee.profile', [
            'profile' => $employeeProfile,
            'educationList' => $educationList,
            'experienceList' => $experienceList,
            'userList' => $userList,
        ]);
    }

    public function edit(EmployeeProfile $employeeProfile)
    {
        $this->authorize('update', $employeeProfile);

        return view('employee.edit_profile', [
            'profile' => $employeeProfile,
        ]);
    }

    public function update(UpdateEmployeeProfileRequest $request, EmployeeProfile $employeeProfile)
    {
        $this->authorize('update', $employeeProfile);
        $employeeProfile->update($request->all());

        return back()->with('success', __('messages.update-success'));
    }

    public function changeImage(Request $request, $image, $id)
    {
        $request->validate([
            'avatar' => 'image',
        ]);
        $profile = EmployeeProfile::findOrFail($id);
        $this->authorize('changeImage', $profile);

        if (isset($request->avatar)) {
            $fileName = time() . '-' . $profile->id . '.' .
                $request->avatar->extension();
            $request->avatar->move(public_path('images'), $fileName);
            $profile->$image = $fileName;
            $profile->save();

            return back()->with('success', __('messages.update-success'));
        }
    }

    public function showCVTemplateList()
    {
        return view('employee.my_cv');
    }

    public function makeCV($template)
    {
        $user = Auth::user();
        $profile = $user->employeeProfile;
        $experienceList = $profile->experiences;
        $educationList = $profile->education;

        return view('employee.' . $template, [
            'user' => $user,
            'profile' => $profile,
            'experienceList' => $experienceList,
            'educationList' => $educationList,
        ]);
    }

    public function showAppliedJobs()
    {
        $jobs = Auth::user()->employeeProfile->jobs;

        return view('employee.applied_jobs', compact('jobs'));
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

    private function addAvatarColumn($data)
    {
        $image = asset('images/' . $data->avatar);

        return '<img height="80" width="80" src="' . $image . '">';
    }

    private function addViewColumn($data)
    {
        $profileURI = route('employee-profiles.show', ['employee_profile' => $data->id]);

        return '<a href="' . $profileURI . '">
            <i class="ti-eye text-info font-weight-bold h3"></i></a>';
    }
}
