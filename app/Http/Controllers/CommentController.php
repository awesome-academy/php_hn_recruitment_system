<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Job;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job)
    {
        $comments = $this->commentRepo->getCommentsByJob($job);

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'comment_id' => ['required', 'integer'],
            'content' => ['required', 'string'],
        ]);

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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'comment_id' => ['required', 'integer'],
        ]);

        $commentId = $request->comment_id;
        $comment = $this->commentRepo->find($commentId);
        Gate::authorize('delete', $comment);

        $this->commentRepo->delete($commentId);

        return response()->json([
            'message' => __('message.update-success'),
        ]);
    }
}
