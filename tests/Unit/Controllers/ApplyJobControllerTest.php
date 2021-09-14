<?php

namespace Tests\Unit\Controllers;

use App\Events\JobApplicationStatusChanged;
use App\Http\Controllers\ApplyJobController;
use App\Http\Requests\ChangeJobApplicationStatusRequest;
use App\Listeners\SendJobApplicationApprovalEmail;
use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\User;
use App\Repositories\EmployeeProfile\EmployeeProfileRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Mockery;
use Tests\TestCase;

class ApplyJobControllerTest extends TestCase
{
    private $jobRepoMock;

    private $employeeProfileRepoMock;

    private $applyJobController;

    public function setUp(): void
    {
        parent::setUp();

        $this->jobRepoMock = Mockery::mock(JobRepositoryInterface::class);
        $this->employeeProfileRepoMock = Mockery::mock(EmployeeProfileRepositoryInterface::class);
        $this->applyJobController = new ApplyJobController(
            $this->jobRepoMock,
            $this->employeeProfileRepoMock
        );
    }

    public function tearDown(): void
    {
        unset(
            $this->jobRepoMock,
            $this->employeeProfileRepoMock,
            $this->applyJobController
        );

        parent::tearDown();
    }

    public function testChangeApplicationStatusSuccessfully()
    {
        $jobId = 1;
        $status = config('user.application_form_status.accepted');
        $request = new ChangeJobApplicationStatusRequest([
            'jobId' => $jobId,
            'status' => $status,
        ]);
        $employeeProfile = EmployeeProfile::factory()->make();
        $job = Job::factory()->make(['id' => $jobId]);
        $user = User::factory()->make();
        $employerProfile = EmployerProfile::factory()->make();
        $user->setRelation('employerProfile', $employerProfile);

        Event::fake([
            JobApplicationStatusChanged::class,
        ]);
        $this
            ->jobRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($jobId)
            ->andReturn($job);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('check-job-owner', $job)
            ->andReturn(new Response(true));
        $this
            ->employeeProfileRepoMock
            ->shouldReceive('changeJobApplicationStatus')
            ->once()
            ->with($employeeProfile, $jobId, $status);
        Auth::shouldReceive('user')
            ->once()
            ->andReturn($user);

        $this->applyJobController->changeStatus($request, $employeeProfile);

        Event::assertDispatched(JobApplicationStatusChanged::class);
        Event::assertListening(
            JobApplicationStatusChanged::class,
            SendJobApplicationApprovalEmail::class
        );
    }

    public function testChangeApplicationStatusWhenJobNotFound()
    {
        $jobId = 1;
        $status = config('user.application_form_status.accepted');
        $request = new ChangeJobApplicationStatusRequest([
            'jobId' => $jobId,
            'status' => $status,
        ]);
        $employeeProfile = EmployeeProfile::factory()->make();
        $this
            ->jobRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($jobId)
            ->andThrow(ModelNotFoundException::class);
        $this->expectException(ModelNotFoundException::class);

        $this->applyJobController->changeStatus($request, $employeeProfile);
    }

    public function testChangeApplicationStatusWhenUnauthorized()
    {
        $jobId = 1;
        $status = config('user.application_form_status.accepted');
        $request = new ChangeJobApplicationStatusRequest([
            'jobId' => $jobId,
            'status' => $status,
        ]);
        $employeeProfile = EmployeeProfile::factory()->make();
        $job = Job::factory()->make(['id' => $jobId]);

        $this
            ->jobRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($jobId)
            ->andReturn($job);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('check-job-owner', $job)
            ->andThrow(AuthorizationException::class);
        $this->expectException(AuthorizationException::class);

        $this->applyJobController->changeStatus($request, $employeeProfile);
    }

    public function testChangeApplicationStatusWhenApplicationNotFound()
    {
        $jobId = 1;
        $status = config('user.application_form_status.accepted');
        $request = new ChangeJobApplicationStatusRequest([
            'jobId' => $jobId,
            'status' => $status,
        ]);
        $employeeProfile = EmployeeProfile::factory()->make();
        $job = Job::factory()->make(['id' => $jobId]);

        $this
            ->jobRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($jobId)
            ->andReturn($job);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('check-job-owner', $job)
            ->andReturn(new Response(true));
        $this
            ->employeeProfileRepoMock
            ->shouldReceive('changeJobApplicationStatus')
            ->once()
            ->andThrow(ModelNotFoundException::class);
        $this->expectException(ModelNotFoundException::class);

        $this->applyJobController->changeStatus($request, $employeeProfile);
    }
}
