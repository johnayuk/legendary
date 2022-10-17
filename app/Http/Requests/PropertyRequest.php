<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            
            'flat_block_number' => 'required',
            'business_name' => 'required',
            'street_name' => 'required',
            'address_description' => 'required',
            'image' => 'required',
            'propertyCode' => 'required',
            'estate_id' => 'required',
            'property_category' => 'required',
            'property_type_id' => 'required',

        ];
    }



    public function messages()
    {
        return [
            'flat_block_number.required' => 'An Flat Number is required',
            'business_name.required' => 'Business Nameis required',
            'street_name.required' => 'Street Name is required',
            'address_description.required' => 'Address Description is required',
            'property_category.required' => 'Property Category is required',
            'property_type_id.required' => 'Property Type is required',
            'estate_id.required' => 'Estate is required',
            'image.required' => 'Estate is required',
        ];
    }

}
