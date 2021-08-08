<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EmployerProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

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

Route::post('change-image/{image}/{id}', [EmployeeProfileController::class, 'changeImage'])->name('change-image');
Route::resource('employee-profiles', EmployeeProfileController::class);
Route::get('cv-template', [EmployeeProfileController::class, 'showCVTemplateList'])->name('template.cv');
Route::get('cv/{template}', [EmployeeProfileController::class, 'makeCV'])->name('edit.cv');
Route::resource('education', EducationController::class)->except([
    'create', 'show', 'edit'
]);
Route::resource('experiences', ExperienceController::class)->except([
    'create', 'show', 'edit'
]);

Route::prefix('employer')
    ->name('employer.')
    ->group(function () {
        Route::resource('profiles', EmployerProfileController::class)->only([
            'show',
            'edit',
            'update',
        ]);
    });

Route::resource('jobs', JobController::class);
Route::get('autocomplete-job', [SearchController::class, 'autocompleteJob'])->name('autocomplete_job');
Route::get('search-job', [SearchController::class, 'searchJobGeneral'])->name('search_job');
Route::get('filter-job', [SearchController::class, 'filterJobs'])->name('filter_job');
