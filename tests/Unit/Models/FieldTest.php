<?php

namespace Tests\Unit\Models;

use App\Models\Field;
use Tests\ModelTestCase;

class FieldTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Field();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'name',
        ];

        $this->runConfigurationAssertions($this->model, $fillable);
    }

    public function testJobsRelation()
    {
        $relation = $this->model->jobs();
        $this->assertHasManyRelation($relation, $this->model);
    }
}
