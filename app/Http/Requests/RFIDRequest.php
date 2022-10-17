<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RFIDRequest extends FormRequest
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
            
            'property_id' => 'required',
            'SN' => 'required',
            'VRNumber' => 'required',
            'image' => 'required',
            'VType' => 'required',
            'VMake' => 'required',


        ];
    }



    public function messages()
    {
        return [
            'property_id.required' => 'Propeerty is required',
            'SN.required' => 'Serial Number is required',
            'VRNumber.required' => 'Vehicle Registration Number is required',
            'VMake.required' => 'Vehicle Make is required',
            'VType.required' => 'Vehicle Type is required',
            'estate_id.required' => 'Estate is required',
            'image.required' => 'Estate is required',
        ];
    }
}
