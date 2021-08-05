<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
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
            'school' => 'required|max:255',
            'degree' => 'required|max:255',
            'field_of_study' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'grade' => 'required|max:255',
        ];
    }
}
