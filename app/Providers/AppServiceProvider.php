<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Conversation\ConversationRepository;
use App\Repositories\Conversation\ConversationRepositoryInterface;
use App\Repositories\Education\EducationRepository;
use App\Repositories\Education\EducationRepositoryInterface;
use App\Repositories\EmployeeProfile\EmployeeProfileRepository;
use App\Repositories\EmployeeProfile\EmployeeProfileRepositoryInterface;
use App\Repositories\EmployerProfile\EmployerProfileRepository;
use App\Repositories\EmployerProfile\EmployerProfileRepositoryInterface;
use App\Repositories\Experience\ExperienceRepository;
use App\Repositories\Experience\ExperienceRepositoryInterface;
use App\Repositories\Field\FieldRepository;
use App\Repositories\Field\FieldRepositoryInterface;
use App\Repositories\Job\JobRepository;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
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
            ExperienceRepositoryInterface::class,
            ExperienceRepository::class,
        );
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
        $this->app->singleton(
            EmployerProfileRepositoryInterface::class,
            EmployerProfileRepository::class,
        );
        $this->app->singleton(
            JobRepositoryInterface::class,
            JobRepository::class,
        );
        $this->app->singleton(
            FieldRepositoryInterface::class,
            FieldRepository::class,
        );
        $this->app->singleton(
            ConversationRepositoryInterface::class,
            ConversationRepository::class,
        );
        $this->app->singleton(
            MessageRepositoryInterface::class,
            MessageRepository::class,
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
