<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\EducationController;
use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use App\Models\EmployeeProfile;
use App\Models\User;
use App\Repositories\Education\EducationRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

    public function testUpdateExistingEducation()
    {
        $education = Education::factory()->make(['id' => 1]);
        $request = new StoreEducationRequest([
            'school' => 'Ha Noi University',
        ]);

        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);
        Gate::shouldReceive('authorize')->with('update', $education)
            ->andReturn(new Response(true));
        $this->educationRepoMock->shouldReceive('update')
            ->with($education->id, $request->all());

        $response = $this->educationController->update($request, $education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testUpdateNonExistingEducation()
    {
        $education = Education::factory()->make(['id' => 1]);
        $request = new StoreEducationRequest([
            'school' => 'Ha Noi University',
        ]);

        $this->educationRepoMock
            ->shouldReceive('find')->with($education->id)
            ->andThrow(ModelNotFoundException::class);

        $this->expectException(ModelNotFoundException::class);
        $this->educationController->update($request, $education->id);
    }

    public function testUpdateEducationNotAuthorized()
    {
        $education = Education::factory()->make(['id' => 1]);
        $request = new StoreEducationRequest([
            'school' => 'Ha Noi University',
        ]);

        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);
        $this->educationRepoMock->shouldReceive('update')
            ->with($education->id, $request->all());
        Gate::shouldReceive('authorize')->with('update', $education)
            ->andThrow(AuthorizationException::class);

        $this->expectException(AuthorizationException::class);
        $response = $this->educationController->update($request, $education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testDestroyExistingEducation()
    {
        $education = Education::factory()->make(['id' => 1]);

        Gate::shouldReceive('authorize')->with('delete', $education)
            ->andReturn(new Response(true));
        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);
        $this->educationRepoMock->shouldReceive('delete')->with($education->id);

        $response = $this->educationController->destroy($education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }

    public function testDestroyNonExistingEducation()
    {
        $this->educationRepoMock
            ->shouldReceive('find')
            ->andThrow(ModelNotFoundException::class);

        $this->expectException(ModelNotFoundException::class);
        $this->educationController->destroy(1);
    }

    public function testDestroyEducationNotAuthorized()
    {
        $education = Education::factory()->make(['id' => 1]);

        Gate::shouldReceive('authorize')->with('delete', $education)
            ->andThrow(AuthorizationException::class);
        $this->educationRepoMock->shouldReceive('find')
            ->with($education->id)->andReturn($education);
        $this->educationRepoMock->shouldReceive('delete')->with($education->id);

        $this->expectException(AuthorizationException::class);
        $response = $this->educationController->destroy($education->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('education.index'), $response->getTargetUrl());
    }
}
