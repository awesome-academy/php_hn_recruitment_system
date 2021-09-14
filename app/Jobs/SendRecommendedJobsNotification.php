<?php

namespace App\Jobs;

use App\Notifications\JobRecommendation;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendRecommendedJobsNotification implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepositoryInterface $userRepo)
    {
        $employeeUsers = $userRepo->getUsersByRole(config('user.employee'));
        Notification::send($employeeUsers, new JobRecommendation());
    }
}
