<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeProfile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEmployeeProfileRequest;
use App\Models\User;

class EmployeeProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = EmployeeProfile::findOrFail($id);
        $educationList = $profile->education;
        $experienceList = $profile->experiences;
        $userList = User::where('is_activated', config('user.status.active'))
            ->where('role', config('user.employee'))
            ->orderBy('created_at')->take(config('user.num_top_users'))->get();

        return view('employee.profile', [
            'profile' => $profile,
            'educationList' => $educationList,
            'experienceList' => $experienceList,
            'userList' => $userList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = EmployeeProfile::find($id);

        if (!empty($profile)) {
            return view('employee.edit_profile', [
                'profile' => $profile,
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeProfileRequest $request, $id)
    {
        $profile = EmployeeProfile::find($id);

        if (!empty($profile)) {
            $profile->update($request->all());

            return back()->with('success', __('messages.update-success'));
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeImage(Request $request, $image, $id)
    {
        $request->validate([
            'avatar' => 'image',
        ]);

        $profile = EmployeeProfile::find($id);

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
