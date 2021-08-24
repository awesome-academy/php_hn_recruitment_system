<?php

namespace Tests\Unit\Models;

use App\Models\EmployeeProfile;
use App\Models\Job;
use App\Models\User;
use Tests\ModelTestCase;

class EmployeeProfileTest extends ModelTestCase
{
    protected function initModel()
    {
        return new EmployeeProfile();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'user_id',
            'name',
            'address',
            'phone_number',
            'gender',
            'birthday',
            'description',
            'skills',
            'certifications',
            'industry',
            'cover_photo',
            'avatar',
        ];

        $casts = [
            'id' => 'int',
            'birthday' => 'date',
        ];

        $this->runConfigurationAssertions($this->model, $fillable, $casts);
    }

    public function testUserRelation()
    {
        $relation = $this->model->user();
        $related = new User();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testEducationRelation()
    {
        $relation = $this->model->education();
        $this->assertHasManyRelation($relation, $this->model);
    }

    public function testExperiencesRelation()
    {
        $relation = $this->model->experiences();
        $this->assertHasManyRelation($relation, $this->model);
    }

    public function testJobsRelation()
    {
        $relation = $this->model->jobs();
        $related = new Job();

        $this->assertBelongsToManyRelation($relation, $this->model, $related);
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
     * @dataProvider provideToUCFirstData
     */
    public function testSkillsSetter($testValue, $expected)
    {
        $this->model->setSkillsAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['skills']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToUCFirstData
     */
    public function testCertificationsSetter($testValue, $expected)
    {
        $this->model->setCertificationsAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['certifications']
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
