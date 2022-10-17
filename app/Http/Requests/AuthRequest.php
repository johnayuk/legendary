<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
                'email' => 'required|unique:users',
                'role_id' => 'required',
                'password' => 'required|min:6',
            ];
        }


        public function messages()
        {
            return [
                'email.required' => 'An Email is required',
                'password.required' => 'Password is required',
                'name.required' => 'Name is required',
                'role_id.required' => 'Role is required',
            ];
        }
}
