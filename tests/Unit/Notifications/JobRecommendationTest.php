<?php

namespace Tests\Unit\Notifications;

use App\Models\User;
use App\Notifications\JobRecommendation;
use Tests\TestCase;

class JobRecommendationTest extends TestCase
{
    private $notification;

    private $notifiable;

    public function setUp(): void
    {
        parent::setUp();

        $this->notification = new JobRecommendation();
        $this->notifiable = User::factory()->make();
    }

    public function testVia()
    {
        $expectedDeliveryChannels = ['broadcast', 'database'];
        $deliveryChannels = $this->notification->via($this->notifiable);

        $this->assertEqualsCanonicalizing($expectedDeliveryChannels, $deliveryChannels);
    }

    public function testToArray()
    {
        $expectedArrayRepresentation = [
            'message' => __('messages.recommend-jobs'),
            'target_url' => route('jobs.recommended'),
        ];

        $arrayRepresentation = $this->notification->toArray($this->notifiable);

        $this->assertEqualsCanonicalizing($expectedArrayRepresentation, $arrayRepresentation);
    }
}
