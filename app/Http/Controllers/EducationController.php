<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use App\Repositories\Education\EducationRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EducationController extends Controller
{
    protected $educationRepo;

    public function __construct(EducationRepositoryInterface $educationRepo)
    {
        $this->educationRepo = $educationRepo;
    }

    public function index()
    {
        $educationList = $this->educationRepo->getEducationByEmployeeProfile();

        return view('employee.education', compact('educationList'));
    }

    public function store(StoreEducationRequest $request)
    {
        $data = $request->all();
        $data['employee_profile_id'] = Auth::user()->employeeProfile->id;
        $this->educationRepo->create($data);

        return redirect()->route('education.index')
            ->with('success', __('messages.update-success'));
    }

    public function update(StoreEducationRequest $request, $id)
    {
        $education = $this->educationRepo->find($id);
        Gate::authorize('update', $education);
        $data = $request->all();
        $this->educationRepo->update($id, $data);

        return redirect()->route('education.index')
            ->with('success', __('messages.update-success'));
    }

    public function destroy($id)
    {
        $education = $this->educationRepo->find($id);
        Gate::authorize('delete', $education);
        $this->educationRepo->delete($id);

        return redirect()->route('education.index')
            ->with('success', __('messages.update-success'));
    }
}
