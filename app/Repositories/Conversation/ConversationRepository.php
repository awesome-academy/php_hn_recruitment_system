<?php

namespace App\Repositories\Conversation;

use App\Models\Conversation;
use App\Repositories\Repository;

class ConversationRepository extends Repository implements ConversationRepositoryInterface
{
    public function getModel()
    {
        return Conversation::class;
    }

    public function getConversationsByUser($userId)
    {
        $conversations = $this->model->where('user_id', $userId)
            ->orWhere('partner_id', $userId)
            ->orderByDesc('updated_at')->with([
                'messages',
                'user',
                'user.employeeProfile',
                'user.employerProfile',
                'partner',
                'partner.employeeProfile',
                'partner.employerProfile',
            ])->get();
        foreach ($conversations as $conversation) {
            $conversation->last_message = $conversation->messages->sortByDesc('updated_at')->first();
            $conversation->contact = $conversation->user_id === $userId ? $conversation->partner : $conversation->user;
            $messages = $conversation->messages->where('is_read', config('user.message.unread'));
            $conversation->unreadNumber = $messages->where('to_id', $userId)->count();
        }

        return $conversations;
    }

    public function getConversation($userId, $partnerId)
    {
        return $this->model->where([['user_id', $userId], ['partner_id', $partnerId]])
            ->orWhere([['user_id', $partnerId], ['partner_id', $userId]])
            ->first();
    }
}
