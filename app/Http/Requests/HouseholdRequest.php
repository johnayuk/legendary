<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseholdRequest extends FormRequest
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
            'user_id' => 'required',
            'RClass' => 'required',
            'RCat' => 'required',

        ];
    }



    public function messages()
    {
        return [
            'property_id.required' => 'A Property is required',
            'user_id.required' => 'Property Owner is required',
            'RClass.required' => 'Resident Class is required',
            'RCat.required' => 'Resident Category is required',
            
        ];
    }
}
