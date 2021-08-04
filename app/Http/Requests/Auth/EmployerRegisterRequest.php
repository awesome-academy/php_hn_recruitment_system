<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployerRegisterRequest extends FormRequest
{
    protected $errorBag = 'employer_registration';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
            'phone_number' => ['nullable', 'digits:10', 'starts_with:0'],
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
        ];
    }
}
