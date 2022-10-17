<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [ 
            'name' => 'required',
            "phone" => "required",
            'email' => 'required|unique:users',
            'address' => 'required',
            'dob' => 'required',
            'image' => 'required',
            'gender' => 'required',
        ];
    }



    public function messages()
    {
        return [
            'email.unique' => 'This email has already been used',
            'dob.required' => 'Date of birth is required',
        ];
    }

}
