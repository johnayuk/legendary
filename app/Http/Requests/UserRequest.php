<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

            'f_name' => 'required',
            'email' => 'required|unique:users',
            'user_type' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'estate_id' => 'required',
            // 'userCode' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'password ' => 'required',

        ];
    }



    public function messages()
    {
        return [
            'email.required' => 'An Email is Has been Taken',
            'password.required' => 'Password is required',
            'f_name.required' => 'Name is required',
            'phone.required' => 'Phone is required',
            'gender.required' => 'Gender is required',
            'status.required' => 'Status is required',
            'estate_id.required' => 'Estate is required',
            'image.required' => 'Image is required',
            'id_type.required' => 'ID Type is required',
            'id_number.required' => 'ID Number is required',
            'user_type.required' => 'User Type is required',


        ];
    }
}