<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
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
            'position' => 'required|max:255',
            'employment_type' => Rule::in(config('user.employment_type')),
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'company' => 'required|max:255',
        ];
    }
}
