<?php

namespace App\Mail;

use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationRejected extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $employeeProfile;

    protected $employerProfile;

    protected $appliedJob;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        EmployeeProfile $employeeProfile,
        EmployerProfile $employerProfile,
        Job $appliedJob
    ) {
        $this->employeeProfile = $employeeProfile;
        $this->employerProfile = $employerProfile;
        $this->appliedJob = $appliedJob;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('messages.application-announcement-email-subject'))
            ->markdown('emails.jobs.applications.rejected')
            ->with([
                'employeeName' => $this->employeeProfile->name,
                'employerName' => $this->employerProfile->name,
                'jobTitle' => $this->appliedJob->title,
            ]);
    }
}
