<?php

namespace App\Events;

use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobApplicationStatusChanged
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $applicationStatus;

    public $appliedJob;

    public $employeeProfile;

    public $employerProfile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        EmployeeProfile $employeeProfile,
        EmployerProfile $employerProfile,
        $appliedJob,
        $applicationStatus
    ) {
        $this->employeeProfile = $employeeProfile;
        $this->employerProfile = $employerProfile;
        $this->applicationStatus = $applicationStatus;
        $this->appliedJob = $appliedJob;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('email-channel');
    }
}
