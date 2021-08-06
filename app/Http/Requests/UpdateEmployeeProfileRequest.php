<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        return true;
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
            'phone_number' => 'required|numeric',
            'gender' => Rule::in(config('user.gender')),
            'birthday' => 'date',
            'address' => 'required|max:255',
            'description' => 'max:500',
            'skills' => 'max:500',
            'certifications' => 'max:500',
            'industry' => 'max:255',
        ];
    }
}
