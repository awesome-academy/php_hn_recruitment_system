<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        $role = Auth::user()->role;
        $isActivated = Auth::user()->is_activated;

        if ($isActivated == config('user.status.active')) {
            if ($role == config('user.admin')) {
                //return admin dashboard
            } elseif ($role == config('user.employee')) {
                return route('jobs.index');
            } elseif ($role == config('user.employer')) {
                return route('home');
            }
        } else {
            return route('inactive');
        }
    }
}
