<?php

namespace Tests\Unit\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\MessageController;
use App\Http\Requests\SendMessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Repositories\Conversation\ConversationRepositoryInterface;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class MessageControllerTest extends TestCase
{
    protected $conversationRepoMock;
    protected $messageRepoMock;
    protected $userRepoMock;
    protected $messageController;

    public function setUp(): void
    {
        parent::setUp();
        $this->conversationRepoMock = Mockery::mock(ConversationRepositoryInterface::class);
        $this->messageRepoMock = Mockery::mock(MessageRepositoryInterface::class);
        $this->userRepoMock = Mockery::mock(UserRepositoryInterface::class);
        $this->messageController = new MessageController(
            $this->conversationRepoMock,
            $this->messageRepoMock,
            $this->userRepoMock
        );
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->conversationRepoMock, $this->messageRepoMock, $this->userRepoMock, $this->messageController);
        parent::tearDown();
    }

    public function testIndexReturnsView()
    {
        $user = User::factory()->make(['id' => 1]);
        Auth::shouldReceive('id')->once()->andReturn($user->id);

        $this->conversationRepoMock->shouldReceive('getConversationsByUser')
            ->with($user->id)->once()->andReturn(new Collection());

        $view = $this->messageController->index();
        $this->assertEquals('message.contact', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('conversations', $data);
    }

    public function testGetMessagesReturnsView()
    {
        $user = User::factory()->make(['id' => 1]);
        $partner = User::factory()->make(['id' => 2]);
        $conversation = Conversation::factory()->make([
            'id' => 1,
            'user_id' => $user->id,
            'partner_id' => $partner->id,
        ]);
        $messages = Message::factory()->for($conversation)->count(5)->make([
            'from_id' => $user->id,
            'to_id' => $partner->id,
        ]);
        $conversation->setRelation('messages', $messages);

        Auth::shouldReceive('id')->once()->andReturn($user->id);
        $this->userRepoMock->shouldReceive('find')
            ->with($partner->id)->once()->andReturn($partner);
        $this->conversationRepoMock->shouldReceive('getConversation')
            ->with($user->id, $partner->id)->once()->andReturn($conversation);

        $view = $this->messageController->getMessages($partner->id);
        $this->assertEquals('message.index', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertEquals($conversation, $data['conversation']);
        $this->assertEquals($messages, $data['messages']);
        $this->assertEquals($partner, $data['receiver']);
    }

    public function testStoreMessageWhenConversationExists()
    {
        Event::fake();
        $sender = User::factory()->make(['id' => 1]);
        $receiver = User::factory()->make(['id' => 2]);
        Auth::shouldReceive('id')->once()->andReturn($sender->id);
        $conversation = Conversation::factory()->make([
            'id' => 1,
            'user_id' => $sender->id,
            'partner_id' => $receiver->id,
        ]);
        $messages = Message::factory()->for($conversation)->count(5)->make([
            'from_id' => $sender->id,
            'to_id' => $receiver->id,
        ]);
        $conversation->setRelation('messages', $messages);
        $request = new SendMessageRequest([
            'toId' => $receiver->id,
            'message' => 'Hello',
        ]);
        $attributes = [
            'from_id' => $sender->id,
            'to_id' => $receiver->id,
            'content' => $request['message'],
            'conversation_id' => $conversation->id,
            'is_read' => config('user.message.unread')
        ];
        $message = Message::factory()->for($conversation)->make($attributes);

        $this->conversationRepoMock->shouldReceive('getConversation')
            ->with($sender->id, $request['toId'])->once()->andReturn($conversation);
        $this->messageRepoMock->shouldReceive('create')
            ->with($attributes)->once()->andReturn($message);
        $this->conversationRepoMock->shouldReceive('update')
            ->with($conversation->id, ['last_message' => $message->id])->once();
        $this->userRepoMock->shouldReceive('find')
            ->with($receiver->id)->once()->andReturn($receiver);

        $view = $this->messageController->store($request);
        Event::assertDispatched(MessageSent::class, 1);
        $this->assertEquals('message.index', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertEquals($conversation, $data['conversation']);
        $this->assertEquals($messages, $data['messages']);
        $this->assertEquals($receiver, $data['receiver']);
    }

    public function testStoreMessageWhenConversationNotExists()
    {
        Event::fake();
        $sender = User::factory()->make(['id' => 1]);
        $receiver = User::factory()->make(['id' => 2]);
        Auth::shouldReceive('id')->once()->andReturn($sender->id);
        $conversation = Conversation::factory()->make([
            'id' => 1,
            'user_id' => $sender->id,
            'partner_id' => $receiver->id,
        ]);
        $messages = Message::factory()->for($conversation)->count(5)->make([
            'from_id' => $sender->id,
            'to_id' => $receiver->id,
        ]);
        $conversation->setRelation('messages', $messages);
        $request = new SendMessageRequest([
            'toId' => $receiver->id,
            'message' => 'Hello',
        ]);
        $attributes = [
            'from_id' => $sender->id,
            'to_id' => $receiver->id,
            'content' => $request['message'],
            'conversation_id' => $conversation->id,
            'is_read' => config('user.message.unread')
        ];
        $message = Message::factory()->for($conversation)->make($attributes);

        $this->conversationRepoMock->shouldReceive('getConversation')
            ->with($sender->id, $request['toId'])->once()->andReturnNull();
        $this->conversationRepoMock->shouldReceive('create')
            ->andReturn($conversation);
        $this->messageRepoMock->shouldReceive('create')
            ->with($attributes)->once()->andReturn($message);
        $this->conversationRepoMock->shouldReceive('update')
            ->with($conversation->id, ['last_message' => $message->id])->once();
        $this->userRepoMock->shouldReceive('find')
            ->with($receiver->id)->once()->andReturn($receiver);

        $view = $this->messageController->store($request);
        Event::assertDispatched(MessageSent::class, 1);
        $this->assertEquals('message.index', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertEquals($conversation, $data['conversation']);
        $this->assertEquals($messages, $data['messages']);
        $this->assertEquals($receiver, $data['receiver']);
    }

    public function testReadMessagesReturnsTrue()
    {
        $user = User::factory()->make(['id' => 1]);
        Auth::shouldReceive('id')->once()->andReturn($user->id);
        $this->messageRepoMock->shouldReceive('readMessages')->once();
        $this->assertTrue($this->messageController->readMessages(1));
    }

    public function testShowChatBoxReturnsView()
    {
        $view = $this->messageController->showChatBox();
        $this->assertEquals('message.chat', $view->getName());
    }

    public function testSearchContactReturnsView()
    {
        $user = User::factory()->make(['id' => 10]);
        $conversation = Conversation::factory()->make([
            'user_id' => $user->id,
            'partner_id' => 2,
        ]);
        $contacts = User::factory()->count(5)->make();
        foreach ($contacts as $key => $contact) {
            $contact->id = $key;
            $contact->conversation = $conversation;
        }
        $request = new Request([
            'query' => 'fpt',
        ]);

        Auth::shouldReceive('id')->andReturn($user->id);
        $this->userRepoMock->shouldReceive('searchByName')
            ->with($request['query'])->once()->andReturn($contacts);
        $this->conversationRepoMock->shouldReceive('getConversation')
            ->andReturn($conversation);

        $view = $this->messageController->searchContact($request);
        $this->assertEquals('message.search_contact', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('contacts', $data);
        $this->assertEquals($contacts, $data['contacts']);
    }
}
