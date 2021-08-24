<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\CommentController;
use App\Models\Comment;
use App\Models\Job;
use App\Models\User;
use App\Repositories\Comment\CommentRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Mockery;
use Tests\TestCase;

/**
 * Test cases:
 * @method testIndexReturnsJsonResponse
 * @method testStoreNewComment
 * @method testStoreNewCommentOnInvalidRequest
 * @method testUpdateExistingComment
 * @method testUpdateUnexistedComment
 * @method testUpdateCommentOnUnauthorized
 * @method testUpdateCommentOnInvalidRequest
 * @method testDestroyExistingComment
 * @method testDestroyUnexistedComment
 * @method testDestroyCommentOnUnauthorized
 * @method testDestroyCommentOnInvalidRequest
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
        $request = new Request([
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
     * Test: Store a comment when the request is invalid
     */
    public function testStoreNewCommentOnInvalidRequest()
    {
        $request = new Request();
        $job = Job::factory()->make();

        $this->expectException(ValidationException::class);

        $this->commentController->store($request, $job);
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
        $request = new Request([
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

        $request = new Request([
            'comment_id' => $comment->id,
            'content' => $comment->content,
        ]);
        $this->commentController->update($request);
    }

    /**
     * Test: Update an unexisted comment
     */
    public function testUpdateUnexistedComment()
    {
        // Init model
        $comment = Comment::factory()->make(['id' => 1]);
        $unexistedCommentId = 2;

        // Set up mock
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($unexistedCommentId)
            ->andThrow(ModelNotFoundException::class);

        // Test
        $this->expectException(ModelNotFoundException::class);

        $request = new Request([
            'comment_id' => $unexistedCommentId,
            'content' => $comment->content,
        ]);
        $this->commentController->update($request);
    }

    /**
     * Test: Update a comment when the request is invalid
     */
    public function testUpdateCommentOnInvalidRequest()
    {
        $request = new Request([
            'comment_id' => null,
            'content' => null,
        ]);

        $this->expectException(ValidationException::class);

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
        $request = new Request(['comment_id' => $comment->id]);
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

        $request = new Request(['comment_id' => $comment->id]);
        $this->commentController->destroy($request);
    }

    /**
     * Test: Delete an unexisted comment
     */
    public function testDestroyUnexistedComment()
    {
        // Init model
        $unexistedCommentId = 2;

        // Set up mock
        $this->commentRepoMock
            ->shouldReceive('find')
            ->once()
            ->with($unexistedCommentId)
            ->andThrow(ModelNotFoundException::class);

        // Test
        $this->expectException(ModelNotFoundException::class);

        $request = new Request(['comment_id' => $unexistedCommentId]);
        $this->commentController->destroy($request);
    }

    /**
     * Test: Delete a comment when the request is invalid
     */
    public function testDestroyCommentOnInvalidRequest()
    {
        $request = new Request();

        $this->expectException(ValidationException::class);

        $this->commentController->destroy($request);
    }
}
