<?php

namespace Tests\Unit\Events;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Tests\TestCase;

class MessageSentTest extends TestCase
{
    public function testConstructorAndBroadcastOn()
    {
        $message = new Message([
            'id' => 111,
        ]);
        $event = new MessageSent($message);
        $this->assertSame($message, $event->message);
        $this->assertInstanceOf(PrivateChannel::class, $event->broadcastOn());
    }
}
