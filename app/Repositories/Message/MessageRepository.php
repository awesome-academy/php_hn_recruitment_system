<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\Repository;

class MessageRepository extends Repository implements MessageRepositoryInterface
{
    public function getModel()
    {
        return Message::class;
    }

    public function readMessages($conversationId, $toId)
    {
        $attributes = [
            'conversation_id' => $conversationId,
            'to_id' => $toId,
        ];
        $messages = $this->model->where($attributes)->get();

        foreach ($messages as $message) {
            $message->is_read = config('user.message.read');
            $message->save();
        }
    }
}
