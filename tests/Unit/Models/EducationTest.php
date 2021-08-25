<?php

namespace Tests\Unit\Models;

use App\Models\Education;
use App\Models\EmployeeProfile;
use Tests\ModelTestCase;

class EducationTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Education();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'employee_profile_id',
            'school',
            'degree',
            'field_of_study',
            'start_date',
            'end_date',
            'grade',
        ];
        $casts = [
            'id' => 'int',
            'start_date' => 'date',
            'end_date' => 'date',
        ];

        $this->runConfigurationAssertions($this->model, $fillable, $casts);
    }

    public function testEmployeeProfileRelation()
    {
        $relation = $this->model->employeeProfile();
        $related = new EmployeeProfile();
        $this->assertBelongsToRelation($relation, $related);
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToTitleData
     */
    public function testSchoolSetter($testValue, $expected)
    {
        $this->model->setSchoolAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['school']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToTitleData
     */
    public function testDegreeSetter($testValue, $expected)
    {
        $this->model->setDegreeAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['degree']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToTitleData
     */
    public function testFieldOfStudySetter($testValue, $expected)
    {
        $this->model->setFieldOfStudyAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['field_of_study']
        );
    }

    /**
     * @param string $testValue
     * @param string $expected
     *
     * @dataProvider provideToUCFirstData
     */
    public function testGradeSetter($testValue, $expected)
    {
        $this->model->setGradeAttribute($testValue);
        $this->assertEquals(
            $expected,
            $this->model->getAttributes()['grade']
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
