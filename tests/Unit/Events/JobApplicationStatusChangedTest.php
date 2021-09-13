<?php

namespace Tests\Unit\Events;

use App\Events\JobApplicationStatusChanged;
use App\Events\MessageSent;
use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Tests\TestCase;

class JobApplicationStatusChangedTest extends TestCase
{
    public function testConstructorAndBroadcastOn()
    {
        $employeeProfile = new EmployeeProfile([
            'id' => 11,
        ]);
        $employerProfile = new EmployerProfile([
            'id' => 11,
        ]);
        $appliedJob =  new Job([
            'id' => 11,
        ]);
        $applicationStatus = config('user.application_form_status.rejected');
        $event = new JobApplicationStatusChanged($employeeProfile, $employerProfile, $appliedJob, $applicationStatus);

        $this->assertSame($employeeProfile, $event->employeeProfile);
        $this->assertSame($employerProfile, $event->employerProfile);
        $this->assertSame($appliedJob, $event->appliedJob);
        $this->assertSame($applicationStatus, $event->applicationStatus);
        $this->assertInstanceOf(PrivateChannel::class, $event->broadcastOn());
    }
}
