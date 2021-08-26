<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\CommentController;
use App\Http\Requests\DestroyCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Job;
use App\Models\User;
use App\Repositories\Comment\CommentRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mockery;
use Tests\TestCase;

/**
 * Test cases:
 * @method testIndexReturnsJsonResponse
 * @method testStoreNewComment
 * @method testStoreNewCommentOnInvalidRequest
 * @method testUpdateExistingComment
 * @method testUpdateNonexistentComment
 * @method testUpdateCommentOnUnauthorized
 * @method testDestroyExistingComment
 * @method testDestroyNonexistentComment
 * @method testDestroyCommentOnUnauthorized
 */
class CommentControllerTest extends TestCase
{
    protected $commentRepoMock;
    protected $commentController;

    public function setUp(): void
    {
        parent::setUp();

        $this->commentRepoMock = Mockery::mock(CommentRepository::class);
        $this->commentController = new CommentController($this->commentRepoMock);
    }

    public function tearDown(): void
    {
        Mockery::close();
        $this->commentRepoMock = null;
        $this->commentController = null;

        parent::tearDown();
    }

    /**
     * Test: Get all comments for the job post and return a JsonResponse with
     * these comments.
     */
    public function testIndexReturnsJsonResponse()
    {
        // Init models
        $job = Job::factory()->make(['id' => 1]);
        $comments = Comment::factory()->for($job)->count(5)->make();

        // Set up mock
        $this->commentRepoMock
            ->shouldReceive('getCommentsByJob')
            ->once()
            ->with($job)
            ->andReturn($comments);

        // Test
        $response = $this->commentController->index($job);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(
            $response->getData(),
            json_decode($comments->toJson())
        );
    }

    /**
     * Test: Store a new comment successfully and return a JsonResponse with
     * created comment
     */
    public function testStoreNewComment()
    {
        // Init models
        $user = User::factory()->make(['id' => 1]);
        $job = Job::factory()->make(['id' => 1]);
        $comment = Comment::factory()->for($job)->make();
        $request = new StoreCommentRequest([
            'content' => $comment->content,
            'job_id' => $job->id,
            'user_id' => $user->id,
        ]);

        // Set up mocks
        $this->commentRepoMock
            ->shouldReceive('create')
            ->once()
            ->with($request->all())
            ->andReturn($comment);
        Auth::shouldReceive('id')->once()->andReturn($user->id);

        // Test
        $response = $this->commentController->store($request, $job);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(
            $response->getData(),
            json_decode($comment->toJson())
        );
    }

    /**
     * Test: Update an existing comment successfully
     */
    public function testUpdateExistingComment()
    {
        // Init model
        $comment = Comment::factory()->make(['id' => 1]);

        // Set up mocks
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($comment->id)
            ->andReturn($comment);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('update', $comment)
            ->andReturn(new AccessResponse(true));
        $comment->content = 'New comment content';
        $this->commentRepoMock
            ->shouldReceive('update')
            ->once()
            ->with($comment->id, ['content' => $comment->content])
            ->andReturn($comment);

        // Test
        $request = new UpdateCommentRequest([
            'comment_id' => $comment->id,
            'content' => $comment->content,
        ]);
        $response = $this->commentController->update($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($response->getData(), (object) [
            'id' => $comment->id,
            'content' => $comment->content,
        ]);
    }

    /**
     * Test: Update an existing comment when the action is unauthorized
     */
    public function testUpdateCommentOnUnauthorized()
    {
        // Init model
        $comment = Comment::factory()->make(['id' => 1]);

        // Set up mocks
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($comment->id)
            ->andReturn($comment);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('update', $comment)
            ->andThrow(AuthorizationException::class);

        // Test
        $this->expectException(AuthorizationException::class);

        $request = new UpdateCommentRequest([
            'comment_id' => $comment->id,
            'content' => $comment->content,
        ]);
        $this->commentController->update($request);
    }

    /**
     * Test: Update an nonexistent comment
     */
    public function testUpdateNonexistentComment()
    {
        // Init model
        $comment = Comment::factory()->make(['id' => 1]);
        $nonexistentCommentId = 2;

        // Set up mock
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($nonexistentCommentId)
            ->andThrow(ModelNotFoundException::class);

        // Test
        $this->expectException(ModelNotFoundException::class);

        $request = new UpdateCommentRequest([
            'comment_id' => $nonexistentCommentId,
            'content' => $comment->content,
        ]);
        $this->commentController->update($request);
    }

    /**
     * Test: Delete an existing comment successfully
     */
    public function testDestroyExistingComment()
    {
        // Init model
        $comment = Comment::factory()->make(['id' => 1]);

        // Set up mock
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($comment->id)
            ->andReturn($comment);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('delete', $comment)
            ->andReturn(new AccessResponse(true));
        $this->commentRepoMock
            ->shouldReceive('delete')
            ->once()
            ->with($comment->id);

        // Test
        $request = new DestroyCommentRequest(['comment_id' => $comment->id]);
        $response = $this->commentController->destroy($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($response->getData(), (object) [
            'message' => __('message.update-success'),
        ]);
    }

    /**
     * Test: Delete an existing comment when the action is unauthorized
     */
    public function testDestroyCommentOnUnauthorized()
    {
        // Init model
        $comment = Comment::factory()->make(['id' => 1]);

        // Set up mocks
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($comment->id)
            ->andReturn($comment);
        Gate::shouldReceive('authorize')
            ->once()
            ->with('delete', $comment)
            ->andThrow(AuthorizationException::class);

        // Test
        $this->expectException(AuthorizationException::class);

        $request = new DestroyCommentRequest(['comment_id' => $comment->id]);
        $this->commentController->destroy($request);
    }

    /**
     * Test: Delete an nonexistent comment
     */
    public function testDestroyNonexistentComment()
    {
        // Init model
        $nonexistentCommentId = 2;

        // Set up mock
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($nonexistentCommentId)
            ->andThrow(ModelNotFoundException::class);

        // Test
        $this->expectException(ModelNotFoundException::class);

        $request = new DestroyCommentRequest(['comment_id' => $nonexistentCommentId]);
        $this->commentController->destroy($request);
    }
}
