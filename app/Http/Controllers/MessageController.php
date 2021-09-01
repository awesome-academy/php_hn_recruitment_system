<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\SendMessageRequest;
use App\Repositories\Conversation\ConversationRepositoryInterface;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $conversationRepo;
    protected $messageRepo;
    protected $userRepo;

    public function __construct(
        ConversationRepositoryInterface $conversationRepo,
        MessageRepositoryInterface $messageRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->conversationRepo = $conversationRepo;
        $this->messageRepo = $messageRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $userId = Auth::id();
        $conversations = $this->conversationRepo->getConversationsByUser($userId);

        return view('message.contact', compact('conversations'));
    }

    public function getMessages($partnerId)
    {
        $receiver = $this->userRepo->find($partnerId);
        $conversation = $this->conversationRepo->getConversation(Auth::id(), $partnerId);
        $messages = $conversation->messages ?? [];

        return view('message.index', compact('conversation', 'messages', 'receiver'));
    }

    public function store(SendMessageRequest $request)
    {
        $fromId = Auth::id();
        $toId = $request->toId;
        $content = $request->message;
        $conversation = $this->conversationRepo->getConversation($fromId, $toId);
        if (!$conversation) {
            $conversation = $this->conversationRepo->create([
                'user_id' => $fromId,
                'partner_id' => $toId,
            ]);
        }
        $message = $this->messageRepo->create([
            'from_id' => $fromId,
            'to_id' => $toId,
            'content' => $content,
            'conversation_id' => $conversation->id,
            'is_read' => config('user.message.unread')
        ]);
        $this->conversationRepo->update($conversation->id, ['last_message' => $message->id]);

        broadcast(new MessageSent($message))->toOthers();
        $receiver = $this->userRepo->find($toId);
        $conversation = $this->conversationRepo->getConversation($fromId, $toId);
        $messages = $conversation->messages ?? [];

        return view('message.index', compact('conversation', 'messages', 'receiver'));
    }

    public function readMessages($conversationId)
    {
        $this->messageRepo->readMessages($conversationId, Auth::id());
    }

    public function showChatBox()
    {
        return view('message.chat');
    }

    public function searchContact(Request $request)
    {
        $query = $request->get('query');
        $contacts = $this->userRepo->searchByName($query);
        foreach ($contacts as $contact) {
            $contact->conversation = $this->conversationRepo->getConversation(Auth::id(), $contact->user_id);
        }

        return view('message.search_contact', compact('contacts'));
    }
}
