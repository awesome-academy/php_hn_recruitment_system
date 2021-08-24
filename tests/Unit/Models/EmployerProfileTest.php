<?php

namespace Tests\Unit\Models;

use App\Models\EmployerProfile;
use App\Models\User;
use Tests\ModelTestCase;

class EmployerProfileTest extends ModelTestCase
{
    protected function initModel()
    {
        return new EmployerProfile();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'name',
            'website',
            'address',
            'phone_number',
            'company_size',
            'company_type',
            'description',
            'industry',
            'cover_photo',
            'logo',
        ];

        $this->runConfigurationAssertions($this->model, $fillable);
    }

    public function testUserRelation()
    {
        $relation = $this->model->user();
        $related = new User();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testJobsRelation()
    {
        $relation = $this->model->jobs();
        $this->assertHasManyRelation($relation, $this->model);
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToTitleData
     */
    public function testNameSetter($testValue, $expected)
    {
        $this->model->setNameAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['name']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToTitleData
     */
    public function testAddressSetter($testValue, $expected)
    {
        $this->model->setAddressAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['address']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToUCFirstData
     */
    public function testDescriptionSetter($testValue, $expected)
    {
        $this->model->setDescriptionAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['description']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToTitleData
     */
    public function testIndustrySetter($testValue, $expected)
    {
        $this->model->setIndustryAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['industry']
        );
    }

    public function provideToTitleData()
    {
        return [
            ['project manager', 'Project Manager'],
            ['project MANAGER', 'Project Manager'],
            ['Project Manager', 'Project Manager'],
            ['%%project manager', '%%Project Manager'],
            [123, 123],
            ['', ''],
        ];
    }

    public function provideToUCFirstData()
    {
        return [
            ['project manager', 'Project manager'],
            ['project MANAGER', 'Project MANAGER'],
            ['Project Manager', 'Project Manager'],
            ['123%%project Manager', '123%%project Manager'],
            [123, 123],
            ['', ''],
        ];
    }
}
