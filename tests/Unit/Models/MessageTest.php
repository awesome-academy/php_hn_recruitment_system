<?php

namespace Tests\Unit\Models;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Tests\ModelTestCase;

class MessageTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Message();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'from_id',
            'to_id',
            'content',
            'conversation_id',
            'is_read',
        ];

        $this->runConfigurationAssertions($this->model, $fillable);
    }

    public function testConversationRelation()
    {
        $relation = $this->model->conversation();
        $related = new Conversation();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testFromRelation()
    {
        $relation = $this->model->from();
        $related = new User();
        $this->assertBelongsToRelation($relation, $related, 'from_id');
    }

    public function testToRelation()
    {
        $relation = $this->model->to();
        $related = new User();
        $this->assertBelongsToRelation($relation, $related, 'to_id');
    }
}
