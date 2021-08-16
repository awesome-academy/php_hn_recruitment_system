<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    const COMMENT_USER_PROFILE_RELATIONS = [
        'employeeProfile:employee_profiles.id,name,avatar',
        'employerProfile:employer_profiles.id,name,logo',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job)
    {
        $comments = $job
            ->comments()
            ->with(static::COMMENT_USER_PROFILE_RELATIONS)
            ->get();

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

        $comment = new Comment();
        $comment['content'] = $request->content;
        $comment['job_id'] = $job->id;
        $comment['user_id'] = Auth::user()->id;
        $comment->save();

        $comment->load(static::COMMENT_USER_PROFILE_RELATIONS);

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

        $comment = Comment::findOrFail($request->comment_id);
        $this->authorize('update', $comment);
        $comment->update(['content' => $request->content]);

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

        $comment = Comment::findOrFail($request->comment_id);
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json([
            'message' => __('message.update-success'),
        ]);
    }
}
