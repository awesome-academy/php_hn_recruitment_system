<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Job;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Job $job)
    {
        $comments = $this->commentRepo->getCommentsByJob($job);

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentRequest $request, Job $job)
    {
        $attributes = [
            'content' => $request->content,
            'job_id' => $job->id,
            'user_id' => Auth::id(),
        ];
        $comment = $this->commentRepo->create($attributes);

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCommentRequest $request)
    {
        $commentId = $request->comment_id;
        $comment = $this->commentRepo->find($commentId);
        Gate::authorize('update', $comment);

        $comment = $this->commentRepo->update($commentId, [
            'content' => $request->content
        ]);

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\DestroyCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyCommentRequest $request)
    {
        $commentId = $request->comment_id;
        $comment = $this->commentRepo->find($commentId);
        Gate::authorize('delete', $comment);

        $this->commentRepo->delete($commentId);

        return response()->json([
            'message' => __('message.update-success'),
        ]);
    }
}
