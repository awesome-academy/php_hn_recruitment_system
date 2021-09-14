<?php

namespace Tests\Unit\Mail;

use App\Mail\JobApplicationRejected;
use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\Job;
use Tests\TestCase;

class JobApplicationRejectedTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMailContent()
    {
        $employeeProfile = EmployeeProfile::factory()->make();
        $employerProfile = EmployerProfile::factory()->make();
        $appliedJob = Job::factory()->make();

        $mail = new JobApplicationRejected(
            $employeeProfile,
            $employerProfile,
            $appliedJob
        );

        $mail->assertSeeInText(__('Hello'));
        $mail->assertSeeInText($employeeProfile->name);
        $mail->assertSeeInText(__('messages.thanks-for-using'));
        $mail->assertSeeInText(__('messages.announcement-title'));
        $mail->assertSeeInText($appliedJob->title);
        $mail->assertSeeInText($employerProfile->name);
        $mail->assertSeeInText(__('messages.result'));
        $mail->assertSeeInText(__('messages.rejected'));
        $mail->assertSeeInText(__('messages.browser-more-jobs'));
        $mail->assertSeeInText(__('messages.best-regard'));
        $mail->assertSeeInText(config('app.name'));
    }
}
