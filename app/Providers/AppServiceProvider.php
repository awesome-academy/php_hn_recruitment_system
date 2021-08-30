<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Education\EducationRepository;
use App\Repositories\Education\EducationRepositoryInterface;
use App\Repositories\EmployeeProfile\EmployeeProfileRepository;
use App\Repositories\EmployeeProfile\EmployeeProfileRepositoryInterface;
use App\Repositories\EmployerProfile\EmployerProfileRepository;
use App\Repositories\EmployerProfile\EmployerProfileRepositoryInterface;
use App\Repositories\Job\JobRepository;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            EducationRepositoryInterface::class,
            EducationRepository::class,
        );
        $this->app->singleton(
            CommentRepositoryInterface::class,
            CommentRepository::class,
        );
        $this->app->singleton(
            EmployeeProfileRepositoryInterface::class,
            EmployeeProfileRepository::class,
        );
        $this->app->singleton(
            EmployerProfileRepositoryInterface::class,
            EmployerProfileRepository::class,
        );
        $this->app->singleton(
            JobRepositoryInterface::class,
            JobRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
