<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Models\EmployeeProfile;
use App\Models\Field;
use App\Models\Job;
use App\Repositories\EmployeeProfile\EmployeeProfileRepositoryInterface;
use App\Repositories\EmployerProfile\EmployerProfileRepositoryInterface;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\UserPreference\UserPreferenceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    protected $employeeProfileRepoMock;
    protected $employerProfileRepoMock;
    protected $jobRepoMock;
    protected $userPreferenceRepoMock;
    protected $homeController;

    public function setUp(): void
    {
        parent::setUp();
        $this->employeeProfileRepoMock = Mockery::mock(EmployeeProfileRepositoryInterface::class);
        $this->employerProfileRepoMock = Mockery::mock(EmployerProfileRepositoryInterface::class);
        $this->jobRepoMock = Mockery::mock(JobRepositoryInterface::class);
        $this->userPreferenceRepoMock = Mockery::mock(UserPreferenceRepositoryInterface::class);
        $this->homeController = new HomeController(
            $this->employeeProfileRepoMock,
            $this->employerProfileRepoMock,
            $this->jobRepoMock,
            $this->userPreferenceRepoMock
        );
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset(
            $this->employeeProfileRepoMock,
            $this->employerProfileRepoMock,
            $this->jobRepoMock,
            $this->homeController
        );
        parent::tearDown();
    }

    public function testIndexIfAjaxRequest()
    {
        $jobs = Job::factory()->count(10)->make();
        $companies = EmployeeProfile::factory()->count(10)->make();
        $fields = Field::factory()->count(10)->make();
        foreach ($jobs as $key => $job) {
            $job->id = $key + 1;
            $job->setRelation('employerProfile', $companies[$key]);
            $job->setRelation('field', $fields[$key]);
        }
        $request = new Request();
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');
        $view = view('layouts.job_data', compact('jobs'))->render();

        $this->jobRepoMock->shouldReceive('getRecentJobs')->andReturn($jobs);
        $this->employerProfileRepoMock->shouldReceive('getTopCompanies')->andReturn($companies);
        $this->jobRepoMock->shouldReceive('getTopJobs')->andReturn($jobs);
        $this->employeeProfileRepoMock->shouldReceive('getRecentEmployees')->andReturn($companies);

        $response = $this->homeController->index($request);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($view, $response->getData()->html);
    }

    public function testIndexIfNotAjaxRequest()
    {
        $jobs = Job::factory()->count(10)->make();
        $companies = EmployeeProfile::factory()->count(10)->make();
        $fields = Field::factory()->count(10)->make();
        foreach ($jobs as $key => $job) {
            $job->id = $key + 1;
            $job->setRelation('employerProfile', $companies[$key]);
            $job->setRelation('field', $fields[$key]);
        }
        $request = new Request();

        $this->jobRepoMock->shouldReceive('getRecentJobs')->andReturn($jobs);
        $this->employerProfileRepoMock->shouldReceive('getTopCompanies')->andReturn($companies);
        $this->jobRepoMock->shouldReceive('getTopJobs')->andReturn($jobs);
        $this->employeeProfileRepoMock->shouldReceive('getRecentEmployees')->andReturn($companies);

        $view = $this->homeController->index($request);
        $this->assertEquals('welcome', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertEquals($jobs, $data['jobs']);
        $this->assertEquals($companies, $data['topCompanies']);
        $this->assertEquals($jobs, $data['topJobs']);
        $this->assertEquals($companies, $data['recentEmployees']);
    }

    public function testChangeLanguageSuccessfully()
    {
        $locale = config('app.languages')[0];
        $response = $this->homeController->changeLanguage($locale);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testShowInactiveReturnsView()
    {
        $view = $this->homeController->showInactive();
        $this->assertEquals('inactive', $view->getName());
    }

    public function testShowAdminDashboardReturnsView()
    {
        $companies = EmployeeProfile::factory()->count(10)->make([
            'status' => config('user.status.inactive')
        ]);
        $this->jobRepoMock->shouldReceive('total')->andReturn(10);
        $this->employeeProfileRepoMock->shouldReceive('total')->andReturn(10);
        $this->employerProfileRepoMock->shouldReceive('total')->andReturn(10);
        $this->employerProfileRepoMock->shouldReceive('getPendingCompanies')->andReturn($companies);

        $view = $this->homeController->showAdminDashboard();
        $this->assertEquals('admin.dashboard', $view->getName());
        $data = $view->getData();
        $this->assertIsArray($data);
        $this->assertEquals(10, $data['cntJobs']);
        $this->assertEquals(10, $data['cntCompanies']);
        $this->assertEquals(10, $data['cntEmployees']);
        $this->assertEquals($companies, $data['pendingCompanies']);
    }

    public function testGetJobStatisticsReturnsView()
    {
        $view = $this->homeController->getJobStatistics();
        $this->assertEquals('admin.statistic', $view->getName());
    }

    public function testGetMonthlyJobData()
    {
        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
        ];
        $this->jobRepoMock->shouldReceive('getAllMonths')->andReturn($months);
        $this->jobRepoMock->shouldReceive('getMonthlyJobCount')->andReturn(5);

        $response = $this->homeController->getMonthlyJobData();
        $this->assertIsArray($response);
        $this->assertArrayHasKey('months', $response);
        $this->assertArrayHasKey('jobCount', $response);
    }

    public function testJobTypeData()
    {
        $types = config('user.job_type');
        $this->jobRepoMock->shouldReceive('getJobTypes')->andReturn($types);
        $this->jobRepoMock->shouldReceive('getJobTypeCount')->andReturn(5);

        $response = $this->homeController->getJobTypeData();
        $this->assertIsArray($response);
        $this->assertArrayHasKey('types', $response);
        $this->assertArrayHasKey('activeCount', $response);
        $this->assertArrayHasKey('inactiveCount', $response);
    }

    public function testGetAppliedData()
    {
        $this->jobRepoMock->shouldReceive('getAppliedData')->andReturn(5);
        $response = $this->homeController->getAppliedData(1);
        $this->assertIsArray($response);
        $this->assertArrayHasKey('appliedStatus', $response);
        $this->assertArrayHasKey('appliedCnt', $response);
    }
}
