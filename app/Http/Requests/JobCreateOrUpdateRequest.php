<?php

namespace App\Http\Requests;

use App\Rules\JobFieldIdAvailable;
use App\Rules\JobTypeAvailable;
use Illuminate\Foundation\Http\FormRequest;

class JobCreateOrUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'job_type' => [
                'required',
                'string',
                'max:255',
                new JobTypeAvailable(),
            ],
            'contact_email' => ['required', 'email'],
            'quantity' => ['required', 'numeric'],
            'salary' => ['required', 'numeric'],
            'requirement' => ['required', 'string'],
            'benefit' => ['required', 'string'],
            'close_at' => ['required', 'date'],
            'field_id' => ['required', 'numeric', new JobFieldIdAvailable()],
        ];
    }
}
