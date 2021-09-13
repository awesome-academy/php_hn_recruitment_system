<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SendRecommendedJobsNotification;
use App\Models\User;
use App\Notifications\JobRecommendation;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use Mockery;
use Tests\TestCase;

class SendRecommendedJobsNotificationTest extends TestCase
{
    private $userRepoMock;

    private $sendNotificationJob;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepoMock = Mockery::mock(UserRepositoryInterface::class);
        $this->sendNotificationJob = new SendRecommendedJobsNotification();
    }

    public function testHandle()
    {
        Notification::fake();
        $employeeUsers = User::factory(10)->make(['role' => config('user.employee')]);
        $this
            ->userRepoMock
            ->shouldReceive('getUsersByRole')
            ->with(config('user.employee'))
            ->andReturn($employeeUsers);

        $this->sendNotificationJob->handle($this->userRepoMock);

        Notification::assertSentTo($employeeUsers, JobRecommendation::class);
    }
}
