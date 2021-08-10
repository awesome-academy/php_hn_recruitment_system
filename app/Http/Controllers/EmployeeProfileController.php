<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeProfile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEmployeeProfileRequest;
use App\Models\User;
use Illuminate\Auth\Middleware\Authorize;

class EmployeeProfileController extends Controller
{
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
}
