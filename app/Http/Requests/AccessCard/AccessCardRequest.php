<?php

namespace App\Http\Requests\AccessCard;

use Illuminate\Foundation\Http\FormRequest;

class AccessCardRequest extends FormRequest
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
            'property_id' => 'required|property_id',
            'SN' => 'required|unique:users',
            'name' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone is required',
            'SN.required' => 'Serial Number is required',
            'property_id.required' => 'Property is required',
            'image.required' => 'Image is required',
        ];
    }
}
