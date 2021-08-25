<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\EducationController;
use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use App\Models\EmployeeProfile;
use App\Models\User;
use App\Repositories\Education\EducationRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class EducationControllerTest extends TestCase
{
    protected $educationRepoMock;
    protected $educationController;

    public function setUp(): void
    {
        parent::setUp();
        $this->educationRepoMock = Mockery::mock(EducationRepository::class);
        $this->educationController = new EducationController($this->educationRepoMock);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->educationController, $this->educationRepoMock);
        parent::tearDown();
    }

    public function testIndexReturnsView()
    {
        $this->educationRepoMock
            ->shouldReceive('getEducationByEmployeeProfile')
            ->once()
            ->andReturn(new Collection());
        $view = $this->educationController->index();
        $this->assertEquals('employee.education', $view->getName());

        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('educationList', $data);
    }

    public function testStoreNewEducation()
    {
        $user = User::factory()->make([
            'role' => config('user.employee'),
        ]);
        $employeeProfile = EmployeeProfile::factory()->make();
        $user->setRelation('employeeProfile', $employeeProfile);
        Auth::shouldReceive('user')->once()->andReturn($user);

        $education = Education::factory()->for($employeeProfile)->make();
        $request = new StoreEducationRequest();
        $request['school'] = $education->school;
        $request['degree'] = $education->degree;
        $request['field_of_study'] = $education->field_of_study;
        $request['start_date'] = $education->start_date;
        $request['grade'] = $education->grade;
        $request['employee_profile_id'] = $employeeProfile->id;

        $this->educationRepoMock->shouldReceive('create')
            ->with($request->all())->andReturn($education);

        $response = $this->educationController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testUpdateEducation()
    {
        $user = User::factory()->make([
            'role' => config('user.employee'),
        ]);
        $employeeProfile = EmployeeProfile::factory()->make([
            'id' => 1,
        ]);
        $user->setRelation('employeeProfile', $employeeProfile);
        $this->be($user);
        $education = Education::factory()->for($employeeProfile)->make([
            'id' => 1,
        ]);

        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);

        $request = new StoreEducationRequest();
        $request['school'] = 'Ha Noi University';
        $this->educationRepoMock->shouldReceive('update')
            ->with($education->id, $request->all());

        $response = $this->educationController->update($request, $education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testUpdateEducationNotAuthorized()
    {
        $user = User::factory()->make([
            'role' => config('user.employee'),
        ]);
        $employeeProfile = EmployeeProfile::factory()->make([
            'id' => 1,
        ]);
        $user->setRelation('employeeProfile', $employeeProfile);
        $education = Education::factory()->for($employeeProfile)->make([
            'id' => 1,
        ]);

        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);

        $request = new StoreEducationRequest();
        $request['school'] = 'Ha Noi University';
        $this->educationRepoMock->shouldReceive('update')
            ->with($education->id, $request->all());

        $this->expectException(AuthorizationException::class);
        $response = $this->educationController->update($request, $education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testDestroyEducation()
    {
        $user = User::factory()->make([
            'role' => config('user.employee'),
        ]);
        $employeeProfile = EmployeeProfile::factory()->make([
            'id' => 1,
        ]);
        $user->setRelation('employeeProfile', $employeeProfile);
        $this->be($user);
        $education = Education::factory()->for($employeeProfile)->make([
            'id' => 1,
        ]);

        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);
        $this->educationRepoMock->shouldReceive('delete')->with($education->id);

        $response = $this->educationController->destroy($education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testDestroyEducationNotAuthorized()
    {
        $user = User::factory()->make([
            'role' => config('user.employee'),
        ]);
        $employeeProfile = EmployeeProfile::factory()->make([
            'id' => 1,
        ]);
        $user->setRelation('employeeProfile', $employeeProfile);
        $education = Education::factory()->for($employeeProfile)->make([
            'id' => 1,
        ]);

        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);
        $this->educationRepoMock->shouldReceive('delete')->with($education->id);

        $this->expectException(AuthorizationException::class);
        $response = $this->educationController->destroy($education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }
}
