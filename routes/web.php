<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::post('change-avatar/{id}', [EmployeeProfileController::class, 'changeAvatar'])->name('change-avatar');
Route::resource('employee-profiles', EmployeeProfileController::class);
