<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

abstract class ModelTestCase extends TestCase
{
    protected $model;

    abstract protected function initModel();

    public function setUp(): void
    {
        parent::setUp();
        $this->model = $this->initModel();
    }

    public function tearDown(): void
    {
        $this->model = null;
        parent::tearDown();
    }

    protected function runConfigurationAssertions(
        Model $model,
        $fillable = [],
        $casts = ['id' => 'int'],
        $hidden = [],
        $dates = ['created_at', 'updated_at'],
        $guarded = ['*'],
        $visible = [],
        $collectionClass = Collection::class,
        $table = null,
        $primaryKey = 'id',
        $connection = null
    ) {
        $this->assertEquals($fillable, $model->getFillable());
        $this->assertEquals($casts, $model->getCasts());
        $this->assertEquals($hidden, $model->getHidden());
        $this->assertEquals($dates, $model->getDates());
        $this->assertEquals($guarded, $model->getGuarded());
        $this->assertEquals($visible, $model->getVisible());
        $this->assertEquals($primaryKey, $model->getKeyName());

        $c = $model->newCollection();
        $this->assertEquals($collectionClass, get_class($c));

        if ($connection !== null) {
            $this->assertEquals($connection, $model->getConnectionName());
        }

        if ($table !== null) {
            $this->assertEquals($table, $model->getTable());
        }
    }

    protected function assertHasOneRelation($relation, Model $model, $key = null, $parent = null)
    {
        $this->assertInstanceOf(HasOne::class, $relation);

        $key = $key ?? $model->getForeignKey();
        $this->assertEquals($key, $relation->getForeignKeyName());

        $parent = $parent ?? $model->getKeyName();
        $this->assertEquals($model->getTable() . '.' . $parent, $relation->getQualifiedParentKeyName());
    }

    protected function assertHasManyRelation($relation, Model $model, $key = null, $parent = null)
    {
        $this->assertInstanceOf(HasMany::class, $relation);

        $key = $key ?? $model->getForeignKey();
        $this->assertEquals($key, $relation->getForeignKeyName());

        $parent = $parent ?? $model->getKeyName();
        $this->assertEquals($model->getTable() . '.' . $parent, $relation->getQualifiedParentKeyName());
    }

    protected function assertBelongsToRelation($relation, Model $related, $key = null, $owner = null)
    {
        $this->assertInstanceOf(BelongsTo::class, $relation);

        $key = $key ?? $related->getForeignKey();
        $this->assertEquals($key, $relation->getForeignKeyName());

        $owner = $owner ?? $related->getKeyName();
        $this->assertEquals($owner, $relation->getOwnerKeyName());
    }

    protected function assertBelongsToManyRelation($relation, Model $model, Model $related, $key = null, $owner = null)
    {
        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $key = $key ?? $model->getForeignKey();
        $this->assertEquals($relation->getTable() . '.' . $key, $relation->getQualifiedForeignPivotKeyName());

        $owner = $owner ?? $related->getForeignKey();
        $this->assertEquals($relation->getTable() . '.' . $owner, $relation->getQualifiedRelatedPivotKeyName());
    }
}
