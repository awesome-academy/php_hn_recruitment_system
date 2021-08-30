<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Models\Experience;
use App\Repositories\Experience\ExperienceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    protected $experienceRepo;

    public function __construct(ExperienceRepositoryInterface $experienceRepo)
    {
        $this->authorizeResource(Experience::class, 'experience');
        $this->experienceRepo = $experienceRepo;
    }

    public function index()
    {
        $experienceList = $this->experienceRepo->getExperienceByEmployeeProfile();

        return view('employee.experience', compact('experienceList'));
    }

    public function store(StoreExperienceRequest $request)
    {
        $attributes = $request->all();
        $attributes['employee_profile_id'] = Auth::user()->employeeProfile->id;
        $this->experienceRepo->create($attributes);

        return back()->with('success', __('messages.update-success'));
    }

    public function update(StoreExperienceRequest $request, Experience $experience)
    {
        $this->experienceRepo->update($experience->id, $request->all());

        return back()->with('success', __('messages.update-success'));
    }

    public function destroy(Experience $experience)
    {
        $this->experienceRepo->delete($experience->id);

        return back()->with('success', __('messages.update-success'));
    }
}
