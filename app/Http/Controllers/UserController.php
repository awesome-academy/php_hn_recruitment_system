<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAccountInfoRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function show()
    {
        $user = Auth::user();
        return view('user.account_info', compact('user'));
    }

    public function update(ChangeAccountInfoRequest $request)
    {
        $user = Auth::user();
        $currentPassword = $this->userRepo->changeAccountInfo($user, $request->all());
        if ($user->wasChanged()) {
            Auth::logoutOtherDevices($currentPassword);
        }

        return redirect()
            ->route('account_info.show', ['user' => $user])
            ->with('success', __('messages.update-success'));
    }

    public function changeStatus(Request $request)
    {
        $this->userRepo->changeStatus($request['user_id']);
        if ($request->ajax()) {
            return __('messages.update-success');
        }

        return back()->with('success', __('messages.update-success'));
    }
}
