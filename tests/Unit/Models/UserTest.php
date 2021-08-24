<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\ModelTestCase;

class UserTest extends ModelTestCase
{
    protected function initModel()
    {
        return new User();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'email',
            'password',
            'role',
            'is_activated',
        ];
        $casts = [
            'id' => 'int',
            'email_verified_at' => 'datetime',
        ];
        $hidden = [
            'password',
            'remember_token',
        ];

        $this->runConfigurationAssertions($this->model, $fillable, $casts, $hidden);
    }

    public function testEmployeeProfileRelation()
    {
        $relation = $this->model->employeeProfile();
        $this->assertHasOneRelation($relation, $this->model);
    }

    public function testEmployerProfileRelation()
    {
        $relation = $this->model->employerProfile();
        $this->assertHasOneRelation($relation, $this->model);
    }

    public function testUserIsAdministrator()
    {
        $this->model->setAttribute('role', config('user.admin'));
        $this->assertTrue($this->model->isAdministrator());

        $this->model->setAttribute('role', config('user.employee'));
        $this->assertFalse($this->model->isAdministrator());

        $this->model->setAttribute('role', config('user.employer'));
        $this->assertFalse($this->model->isAdministrator());
    }

    public function testUserIsEmployee()
    {
        $this->model->setAttribute('role', config('user.employee'));
        $this->assertTrue($this->model->isEmployee());

        $this->model->setAttribute('role', config('user.admin'));
        $this->assertFalse($this->model->isEmployee());

        $this->model->setAttribute('role', config('user.employer'));
        $this->assertFalse($this->model->isEmployee());
    }

    public function testUserIsEmployer()
    {
        $this->model->setAttribute('role', config('user.employer'));
        $this->assertTrue($this->model->isEmployer());

        $this->model->setAttribute('role', config('user.employee'));
        $this->assertFalse($this->model->isEmployer());

        $this->model->setAttribute('role', config('user.admin'));
        $this->assertFalse($this->model->isEmployer());
    }
}
