<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Job;
use Tests\ModelTestCase;

class CommentTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Comment();
    }

    public function testModelConfiguration()
    {
        $fillable = ['content'];
        $casts = [
            'id' => 'int',
            'created_at' => 'datetime:d-m-Y H:i',
            'updated_at' => 'datetime:d-m-Y H:i',
        ];

        $this->runConfigurationAssertions($this->model, $fillable, $casts);
    }

    public function testJobRelation()
    {
        $relation = $this->model->job();
        $related = new Job();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testEmployeeProfileRelation()
    {
        $employeeProfile = $this->model->employeeProfile();

        $this->assertHasOneThroughRelation(
            $employeeProfile,
            $this->model,
            'id',
            'user_id',
            'user_id',
            'id'
        );
    }

    public function testEmployerProfileRelation()
    {
        $employerProfile = $this->model->employerProfile();

        $this->assertHasOneThroughRelation(
            $employerProfile,
            $this->model,
            'id',
            'user_id',
            'user_id',
            'id'
        );
    }
}
