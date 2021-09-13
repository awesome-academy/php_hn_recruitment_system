<?php

namespace Tests\Unit\Models;

use App\Models\Conversation;
use App\Models\User;
use Tests\ModelTestCase;

class ConversationTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Conversation();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'user_id',
            'partner_id',
            'last_message',
        ];

        $this->runConfigurationAssertions($this->model, $fillable);
    }

    public function testUserRelation()
    {
        $relation = $this->model->user();
        $related = new User();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testPartnerRelation()
    {
        $relation = $this->model->partner();
        $related = new User();
        $this->assertBelongsToRelation($relation, $related, 'partner_id');
    }

    public function testMessagesRelation()
    {
        $relation = $this->model->messages();
        $this->assertHasManyRelation($relation, $this->model);
    }
}
