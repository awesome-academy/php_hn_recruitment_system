<?php

namespace Tests\Unit\Models;

use App\Models\EmployeeProfile;
use App\Models\Experience;
use Tests\ModelTestCase;

class ExperienceTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Experience();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'employee_profile_id',
            'position',
            'employment_type',
            'start_date',
            'end_date',
            'company',
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
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerTestPositionAndCompanyMutators
     */
    public function testPositionMutator($originalString, $expectedResult)
    {
        $this->model->setPositionAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['position']);
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerTestPositionAndCompanyMutators
     */
    public function testCompanyMutator($originalString, $expectedResult)
    {
        $this->model->setCompanyAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['company']);
    }

    public function providerTestPositionAndCompanyMutators()
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
}
