<?php

namespace App\Listeners;

use App\Events\JobApplicationStatusChanged;
use App\Mail\JobApplicationApproved;
use App\Mail\JobApplicationRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendJobApplicationApprovalEmail
{
    use InteractsWithQueue;

    public $afterCommit = true;

    /**
     * Handle the event.
     *
     * @param  JobApplicationStatusChanged  $event
     * @return void
     */
    public function handle(JobApplicationStatusChanged $event)
    {
        $employeeProfile = $event->employeeProfile;
        $employerProfile = $event->employerProfile;
        $applicationStatus = $event->applicationStatus;
        $appliedJob = $event->appliedJob;

        switch ($applicationStatus) {
            case config('user.application_form_status.accepted'):
                return Mail::to($employeeProfile->user)
                    ->send(new JobApplicationApproved(
                        $employeeProfile,
                        $employerProfile,
                        $appliedJob
                    ));
            case config('user.application_form_status.rejected'):
                return Mail::to($employeeProfile->user)
                    ->send(new JobApplicationRejected(
                        $employeeProfile,
                        $employerProfile,
                        $appliedJob
                    ));
        }
    }
}
