<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Education;
use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\Experience;
use App\Models\Job;
use App\Policies\CommentPolicy;
use App\Policies\EducationPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\EmployerProfilePolicy;
use App\Policies\ExperiencePolicy;
use App\Policies\JobPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        EmployeeProfile::class => EmployeeProfilePolicy::class,
        EmployerProfile::class => EmployerProfilePolicy::class,
        Education::class => EducationPolicy::class,
        Experience::class => ExperiencePolicy::class,
        Comment::class => CommentPolicy::class,
        Experience::class => ExperiencePolicy::class,
        Job::class => JobPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function (User $user) {
            return $user->isAdministrator();
        });
        Gate::define('is-employee', function (User $user) {
            return $user->isEmployee();
        });
        Gate::define('is-employer', function (User $user) {
            return $user->isEmployer();
        });
        Gate::define('check-job-owner', function (User $user, Job $job) {
            return $user->employerProfile->id === $job->employer_profile_id;
        });
    }
}
