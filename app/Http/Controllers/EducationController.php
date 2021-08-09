<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function index()
    {
        $educationList = Auth::user()->employeeProfile->education;

        return view('employee.education', [
            'educationList' => $educationList,
        ]);
    }

    public function store(StoreEducationRequest $request)
    {
        Education::create([
            'employee_profile_id' => Auth::user()->employeeProfile->id,
            'school' => $request->school,
            'degree' => $request->degree,
            'field_of_study' => $request->field_of_study,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'grade' => $request->grade,
        ]);

        return back()->with('success', __('messages.update-success'));
    }

    public function update(StoreEducationRequest $request, $id)
    {
        $education = Education::find($id);

        if (!empty($education)) {
            $education->update($request->all());

            return back()->with('success', __('messages.update-success'));
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $education = Education::find($id);

        if (!empty($education)) {
            $education->delete();

            return back()->with('success', __('messages.update-success'));
        } else {
            abort(404);
        }
    }
}