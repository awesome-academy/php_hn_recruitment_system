<?php
namespace App\Repositories\Education;

use App\Models\Education;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class EducationRepository extends Repository implements EducationRepositoryInterface
{
    public function getModel()
    {
        return Education::class;
    }

    public function getEducationByEmployeeProfile()
    {
        return Auth::user()->employeeProfile->education;
    }
}
