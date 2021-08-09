<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerUpdateRequest;
use App\Models\EmployerProfile;

class EmployerProfileController extends Controller
{
    /**
     * Display the specified employee profile.
     *
     * @param  \App\Models\EmployerProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployerProfile $profile)
    {
        return view('employer.profile', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified employee profile.
     *
     * @param  \App\Models\EmployerProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployerProfile $profile)
    {
        $this->authorize('update', $profile);

        return view('employer.edit_profile', ['profile' => $profile]);
    }

    /**
     * Update the specified employee profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployerProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(
        EmployerUpdateRequest $request,
        EmployerProfile $profile
    ) {
        $this->authorize('update', $profile);

        $profile->update([
            'name' => $request->name,
            'website' => $request->website,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'company_size' => $request->company_size,
            'company_type' => $request->company_type,
            'description' => $request->description,
            'industry' => $request->industry,
        ]);
        $this->updateImageAttribute($request, $profile, 'logo');
        $this->updateImageAttribute($request, $profile, 'cover_photo');

        return redirect()->route('employer.profiles.show', [
            'profile' => $profile,
        ]);
    }

    private function updateImageAttribute($request, $profile, $attributeName)
    {
        if ($request->hasFile($attributeName)) {
            $photoPath = $request
                ->file($attributeName)
                ->storePublicly('public/images');
            $profile->update([$attributeName => $photoPath]);
        }
    }
}
