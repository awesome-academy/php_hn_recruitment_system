<?php

namespace Tests\Unit\Console;

use App\Jobs\SendRecommendedJobsNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class KernelTest extends TestCase
{
    public function testSchedule()
    {
        Queue::fake();

        $nextScheduledTime = Carbon::parse('next friday at 19:00');
        $this->travelTo($nextScheduledTime);
        Artisan::call('schedule:run');

        $this->travelTo($nextScheduledTime->addDays(7)); // to next week
        Artisan::call('schedule:run');

        Queue::assertPushed(SendRecommendedJobsNotification::class, 2);
    }
}
