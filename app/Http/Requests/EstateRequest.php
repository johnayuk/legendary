<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstateRequest extends FormRequest
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
            'address' => 'required',
            'no_of_resident_users' => 'required',
            'security_company' => 'required',
            'phone' => 'required',
            // 'image' => 'required',
            'longitude' => 'required',
            'status' => 'required',
            'manager_id' => 'required',
            'longitude' => 'required',
            'description' => 'required',

        ];

    }


    public function messages()
    {

        return [
            'address.required' => 'Address is required',
            'security_company.required' => 'Security Company is required',
            'name.required' => 'Estate Name is required',
            'phone.required' => 'Phone is required',
            'latitude.required' => 'Latitude is required',
            'status.required' => 'Status is required',
            'manager_id.required' => 'Estate Manager is required',
            'longitude.required' => 'Longitude is required',
            // 'image.required' => 'Image is required',


            // 'image.required' => 'Estate is required',
        ];

    }

}
