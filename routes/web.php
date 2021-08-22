<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplyJobController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\EmployerProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Routes do not need authenticating */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/inactive', [HomeController::class, 'showInactive'])->name('inactive');

Route::get('/change-language/{locale}', [
    HomeController::class,
    'changeLanguage',
])->name('change-language');

Auth::routes([
    'register' => false,
]);

Route::get('/register', [
    RegisterController::class,
    'showRegistrationForm',
])->name('register');

Route::name('register.')->group(function () {
    Route::post('/register-employee', [
        RegisterController::class,
        'registerEmployee',
    ])->name('employee');
    Route::post('/register-employer', [
        RegisterController::class,
        'registerEmployer',
    ])->name('employer');
});

Route::get('autocomplete-job', [
    SearchController::class,
    'autocompleteJob',
])->name('autocomplete_job');

Route::get('search-job', [SearchController::class, 'searchJobGeneral'])->name(
    'search_job'
);

Route::get('search-user', [
    SearchController::class,
    'searchUsers'
])->name('search_user');

/* Routes need authenticating */

Route::middleware('auth')->group(function () {

    /* Employee */

    Route::middleware('can:is-employee')->group(function () {
        Route::resource('education', EducationController::class)->except([
            'create',
            'show',
            'edit',
        ]);

        Route::resource('experiences', ExperienceController::class)->except([
            'create',
            'show',
            'edit',
        ]);

        Route::get('cv-template', [
            EmployeeProfileController::class,
            'showCVTemplateList',
        ])->name('template.cv');

        Route::get('cv/{template}', [
            EmployeeProfileController::class,
            'makeCV',
        ])->name('edit.cv');

        Route::post('change-image/{image}/{id}', [
            EmployeeProfileController::class,
            'changeImage',
        ])->name('change-image');

        Route::get('applied-jobs', [
            EmployeeProfileController::class,
            'showAppliedJobs',
        ])->name('applied_jobs');

        Route::prefix('apply-jobs')
            ->name('apply_jobs.')
            ->group(function () {
                Route::get('/{jobId}', [
                    ApplyJobController::class,
                    'create',
                ])->name('create');

                Route::post('/{jobId}', [
                    ApplyJobController::class,
                    'store',
                ])->name('store');

                Route::put('/{jobId}', [
                    ApplyJobController::class,
                    'update',
                ])->name('update');

                Route::delete('/{jobId}', [
                    ApplyJobController::class,
                    'destroy',
                ])->name('destroy');
            });
    });

    /* Admin */

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('auth', 'can:is-admin')
        ->group(function () {
            Route::resource('employee-profiles', EmployeeProfileController::class);
            Route::resource('employer-profiles', EmployerProfileController::class);
            Route::get('dashboard', [
                HomeController::class,
                'showAdminDashboard'
            ])->name('dashboard');

            Route::post('users/change-status', [
                UserController::class,
                'changeStatus',
            ])->name('change_user_status');

            Route::get('manage-jobs', [JobController::class, 'showManagementForAdmin'])
                ->name('manage-jobs');
        });

    /* Employer */

    Route::middleware('can:is-employer')->group(function () {
        Route::prefix('/jobs')
            ->name('jobs.')
            ->group(function () {
                Route::post('change-status', [
                    JobController::class,
                    'changeStatus',
                ])->name('change_status');

                Route::get('/{job}/candidates', [
                    JobController::class,
                    'showCandidates',
                ])->name('candidates');
            });
    });

    Route::prefix('/jobs')
        ->name('jobs.')
        ->group(function () {
            Route::name('comments.')->group(function () {
                Route::post('/{job}/comments', [
                    CommentController::class,
                    'store'
                ])->name('store');
            });
        });

    Route::name('comments.')->group(function () {
        Route::match(
            ['put', 'patch'],
            '/comments',
            [CommentController::class, 'update']
        )->name('update');
        Route::delete('/comments', [CommentController::class, 'destroy'])
            ->name('destroy');
    });

    Route::get('account_info', [UserController::class, 'show'])
        ->name('account_info.show');
    Route::patch('account_info', [UserController::class, 'update'])
        ->name('account_info.update');
});

Route::resource('employee-profiles', EmployeeProfileController::class);

Route::prefix('employer')
    ->name('employer.')
    ->group(function () {
        Route::resource('profiles', EmployerProfileController::class)->only([
            'show',
            'edit',
            'update',
        ]);

        Route::get('/{profile}/jobs', [
            EmployerProfileController::class,
            'showEmployerJobs',
        ])->name('jobs');

        Route::post('change-application-status/{employeeProfile}', [
            ApplyJobController::class,
            'changeStatus',
        ])->name('change_application_status');
    });

Route::resource('jobs', JobController::class);
Route::prefix('/jobs')
    ->name('jobs.')
    ->group(function () {
        Route::name('comments.')->group(function () {
            Route::get('/{job}/comments', [
                CommentController::class,
                'index'
            ])->name('index');
        });
    });
