<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'phone_number' => 'nullable|numeric',
            'gender' => Rule::in(config('user.gender')),
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'skills' => 'nullable|string|max:500',
            'certifications' => 'nullable|string|max:500',
            'industry' => 'nullable|string|max:255',
        ];
    }
}
