<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        $experienceList = Auth::user()->employeeProfile->experiences;

        return view('employee.experience', [
            'experienceList' => $experienceList,
        ]);
    }

    public function store(StoreExperienceRequest $request)
    {
        Experience::create([
            'employee_profile_id' => Auth::user()->employeeProfile->id,
            'position' => $request->position,
            'employment_type' => $request->employment_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'company' => $request->company,
        ]);

        return back()->with('success', __('messages.update-success'));
    }

    public function update(StoreExperienceRequest $request, $id)
    {
        $experience = Experience::find($id);

        if (!empty($experience)) {
            $experience->update($request->all());

            return back()->with('success', __('messages.update-success'));
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $experience = Experience::find($id);

        if (!empty($experience)) {
            $experience->delete();

            return back()->with('success', __('messages.update-success'));
        } else {
            abort(404);
        }
    }
}
