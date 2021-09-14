<?php

namespace Tests\Unit\Listeners;

use App\Events\JobApplicationStatusChanged;
use App\Listeners\SendJobApplicationApprovalEmail;
use App\Mail\JobApplicationApproved;
use App\Mail\JobApplicationRejected;
use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendJobApplicationApprovalEmailTest extends TestCase
{
    private $user;

    private $employeeProfile;

    private $employerProfile;

    private $appliedJob;

    private $listener;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->make(['id' => 1]);
        $this->employeeProfile = EmployeeProfile::factory()->make(['id' => 1]);
        $this->employeeProfile->setRelation('user', $this->user);
        $this->employerProfile = EmployerProfile::factory()->make(['id' => 1]);
        $this->appliedJob = Job::factory()->make(['id' => 1]);

        $this->listener = new SendJobApplicationApprovalEmail();
    }

    public function tearDown(): void
    {
        unset(
            $this->user,
            $this->employeeProfile,
            $this->employerProfile,
            $this->appliedJob,
            $this->listener
        );

        parent::tearDown();
    }

    public function testHandleSendApprovedEmail()
    {
        $event = new JobApplicationStatusChanged(
            $this->employeeProfile,
            $this->employerProfile,
            $this->appliedJob,
            config('user.application_form_status.accepted')
        );
        $user = $this->user;
        Mail::fake();

        $this->listener->handle($event);

        Mail::assertSent(JobApplicationApproved::class, function ($mail) use ($user) {
            return $mail->hasTo($user);
        });
    }

    public function testHandleSendRejectedEmail()
    {
        $event = new JobApplicationStatusChanged(
            $this->employeeProfile,
            $this->employerProfile,
            $this->appliedJob,
            config('user.application_form_status.rejected')
        );
        $user = $this->user;
        Mail::fake();

        $this->listener->handle($event);

        Mail::assertSent(JobApplicationRejected::class, function ($mail) use ($user) {
            return $mail->hasTo($user);
        });
    }

    public function testHandleInvalidJobApplicationStatus()
    {
        $event = new JobApplicationStatusChanged(
            $this->employeeProfile,
            $this->employerProfile,
            $this->appliedJob,
            'invalid_status'
        );

        $result = $this->listener->handle($event);

        $this->assertEquals(false, $result);
    }
}
