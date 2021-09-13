<?php

namespace Tests\Unit\Models;

use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\Field;
use App\Models\Job;
use Illuminate\Support\Carbon;
use Tests\ModelTestCase;

class JobTest extends ModelTestCase
{
    protected function initModel()
    {
        return new Job();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'field_id',
            'title',
            'description',
            'location',
            'contact_email',
            'job_type',
            'quantity',
            'salary',
            'requirement',
            'benefit',
            'image',
            'status',
            'close_at',
        ];

        $this->runConfigurationAssertions($this->model, $fillable);
    }

    public function testFieldRelation()
    {
        $relation = $this->model->field();
        $related = new Field();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testEmployerProfileRelation()
    {
        $relation = $this->model->employerProfile();
        $related = new EmployerProfile();
        $this->assertBelongsToRelation($relation, $related);
    }

    public function testEmployeeProfilesRelation()
    {
        $relation = $this->model->employeeProfiles();
        $related = new EmployeeProfile();
        $this->assertBelongsToManyRelation($relation, $this->model, $related);
    }

    public function testCommentsRelation()
    {
        $relation = $this->model->comments();
        $this->assertHasManyRelation($relation, $this->model);
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerTestDateAccessors
     */
    public function testCloseAtAccessor($originalString, $expectedResult)
    {
        $this->model->setRawAttributes([
            'close_at' => $originalString,
        ]);
        $this->assertEquals($expectedResult, $this->model->getAttributeValue('close_at'));

        // Abnormal case
        $this->expectException(\InvalidArgumentException::class);
        $this->model->getCloseAtAttribute('not-a-datetime');
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerTestDateAccessors
     */
    public function testCreatedAtAccessor($originalString, $expectedResult)
    {
        $this->model->setRawAttributes([
            'created_at' => $originalString,
        ]);
        $this->assertEquals($expectedResult, $this->model->getAttributeValue('created_at'));

        // Abnormal case
        $this->expectException(\InvalidArgumentException::class);
        $this->model->getCreatedAtAttribute('not-a-datetime');
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerTestSalaryAccessor
     */
    public function testSalaryAccessor($originalString, $expectedResult)
    {
        $this->model->setRawAttributes([
            'salary' => $originalString,
        ]);
        $this->assertEquals($expectedResult, $this->model->getAttributeValue('salary'));
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerToTitleMutators
     */
    public function testTitleMutator($originalString, $expectedResult)
    {
        $this->model->setTitleAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['title']);
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerToTitleMutators
     */
    public function testLocationMutator($originalString, $expectedResult)
    {
        $this->model->setLocationAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['location']);
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerToUCFirstMutators
     */
    public function testDescriptionMutator($originalString, $expectedResult)
    {
        $this->model->setDescriptionAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['description']);
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerToUCFirstMutators
     */
    public function testRequirementMutator($originalString, $expectedResult)
    {
        $this->model->setRequirementAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['requirement']);
    }

    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerToUCFirstMutators
     */
    public function testBenefitMutator($originalString, $expectedResult)
    {
        $this->model->setBenefitAttribute($originalString);
        $this->assertEquals($expectedResult, $this->model->getAttributes()['benefit']);
    }

    public function testScopeActive()
    {
        $query = Job::factory()->count(10)->make();
        $result = $query->where('status', config('user.job_status.active'));
        $this->assertEquals($result, $this->model->scopeActive($query));
    }

    public function providerTestDateAccessors()
    {
        return [
            ['2018-10-18 14:15:43', '2018-10-18'],
            ['10:30pm April 15 2014', '2014-04-15'],
        ];
    }

    public function providerTestSalaryAccessor()
    {
        return [
            [40000, '$40,000'],
            [500, '$500'],
            [100000, '$100,000'],
            ['not-an-integer', 0],
        ];
    }

    public function providerToTitleMutators()
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

    public function providerToUCFirstMutators()
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
