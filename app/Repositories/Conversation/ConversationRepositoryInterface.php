<?php

namespace App\Repositories\Conversation;

use App\Repositories\RepositoryInterface;

interface ConversationRepositoryInterface extends RepositoryInterface
{
    public function getConversationsByUser($userId);
}
