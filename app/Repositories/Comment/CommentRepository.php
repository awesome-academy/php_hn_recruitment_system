<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\Repository;

class CommentRepository extends Repository implements CommentRepositoryInterface
{
    public const COMMENT_USER_PROFILE_RELATIONS = [
        'employeeProfile:employee_profiles.id,name,avatar',
        'employerProfile:employer_profiles.id,name,logo',
    ];

    public function getModel()
    {
        return Comment::class;
    }

    public function getCommentsByJob($job)
    {
        $comments = $job
            ->comments()
            ->with(static::COMMENT_USER_PROFILE_RELATIONS)
            ->get();

        return $comments;
    }

    public function create($attributes = [])
    {
        $comment = new Comment();
        $comment->content = $attributes['content'];
        $comment->job_id = $attributes['job_id'];
        $comment->user_id = $attributes['user_id'];
        $comment->save();

        $comment->load(static::COMMENT_USER_PROFILE_RELATIONS);

        return $comment;
    }
}
