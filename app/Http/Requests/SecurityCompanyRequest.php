<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecurityCompanyRequest extends FormRequest
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
            'email' => 'required|unique:security_companies',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'image' => 'required',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email already is required',
            'phone.required' => 'Phone Number is required',
            'address.required' => 'Address Class is required',
            'status.required' => 'Status is required',
            'image.required' => 'Image is required',
            
        ];
    }

}
