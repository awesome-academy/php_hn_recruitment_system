<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeProfileRequest;
use Illuminate\Http\Request;
use App\Models\EmployeeProfile;

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
        //
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

    public function changeAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'image',
        ]);

        $profile = EmployeeProfile::find($id);

        if (isset($request->avatar)) {
            $fileName = time() . '-' . $profile->id . '.' .
                $request->avatar->extension();
            $request->avatar->move(public_path('images'), $fileName);
            $profile->avatar = $fileName;
            $profile->save();

            return back()->with('success', __('messages.update-success'));
        }
    }
}
