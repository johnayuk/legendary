<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtisanRequest extends FormRequest
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
            'l_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'business_name' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',


        ];
    }



    public function messages()
    {
        return [
            'phone.required' => 'Phone is required',
            'email.required' => 'Password has been taken already',
            'f_name.required' => 'f_name is required',
            'l_name.required' => 'last Name is required',
            'status.required' => 'Status is required',
            'address.required' => 'Address is required',
            'image.required' => 'Image is required',
            'business_name.required' => 'Business Name is required',
            'id_type.required' => 'ID Type is required',
            'id_number.required' => 'ID Name is required',
            'gender.required' => 'Gender is required',



        ];
    }
}
