<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAccountInfoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('user.account_info', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ChangeAccountInfoRequest $request)
    {
        $user = Auth::user();
        $currentPassword = $request->current_password;

        $user->email = $request->email ?? $user->email;
        if ($request->new_password !== null) {
            $user->password = Hash::make($request->new_password);
            $currentPassword = $request->new_password;
        }
        $user->save();

        if ($user->wasChanged()) {
            Auth::logoutOtherDevices($currentPassword);
        }

        return redirect()
            ->route('account_info.show', ['user' => $user])
            ->with('success', __('messages.update-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $user->is_activated = !$user->is_activated;
        $user->save();

        if ($request->ajax()) {
            return __('messages.update-success');
        } else {
            return back()->with('success', __('messages.update-success'));
        }
    }
}
