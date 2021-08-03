<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmployeeRegisterRequest;
use App\Http\Requests\Auth\EmployerRegisterRequest;
use App\Models\EmployeeProfile;
use App\Models\EmployerProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    public function registerEmployee(EmployeeRegisterRequest $request)
    {
        $user = $this->createUser(
            $request->email,
            $request->password,
            config('user.employee')
        );
        $this->createEmployeeProfile($user->id, $request->name);

        $successMessage = __('messages.employee-registered');

        return redirect()
            ->route('login')
            ->with('successMessage', $successMessage);
    }

    public function registerEmployer(EmployerRegisterRequest $request)
    {
        $user = $this->createUser(
            $request->email,
            $request->password,
            config('user.employer')
        );
        $this->createEmployerProfile(
            $user->id,
            $request->name,
            $request->phone_number,
            $request->website,
            $request->address,
            $request->industry
        );

        $successMessage = __('messages.employer-registered');

        return redirect()
            ->route('login')
            ->with('successMessage', $successMessage);
    }

    private function createUser($email, $password, $role)
    {
        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->is_activated = $role === config('user.employee');
        $user->save();

        return $user;
    }

    private function createEmployeeProfile($user_id, $name)
    {
        $profile = new EmployeeProfile(['name' => $name]);
        $profile->user_id = $user_id;
        $profile->save();

        return $profile;
    }

    private function createEmployerProfile(
        $user_id,
        $name,
        $phone_number,
        $website,
        $address,
        $industry
    ) {
        $profile = new EmployerProfile([
            'name' => $name,
            'phone_number' => $phone_number,
            'website' => $website,
            'address' => $address,
            'industry' => $industry,
        ]);
        $profile->user_id = $user_id;
        $profile->save();

        return $profile;
    }
}
