<?php

namespace App\Validations;
use Illuminate\Support\Facades\Validator;
/**
 * Authentication validation
 *
 * This class contains functions that helps in validating the request coming from the form
 *
 */

 class GlobalValidator{
    protected static $validation_rules = [];

    public static function validation_rules($request, string $arg)
    {
        self::$validation_rules = [
            "login" => [
                'user' => 'required',
                'password' => 'required',
            ],

            /** 
             * 
             * validaton condition for password
             * 
             * English uppercase characters (A – Z)
             * English lowercase characters (a – z)
             * Base 10 digits (0 – 9)
             * Unicode characters
            */
            
            "register" => [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*/',
                'phone'=> 'required|min:11|max:11',
            ],

            "profile" => [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone'=> 'required|min:11|max:11',
                'address'=> 'required',
                'avatar'=>'nullable|image|mimes:jpg,jpeg,png',
            ],

            "send-otp" =>[
                "category" => 'required'
            ],

            "verify-otp" =>[
                "category" => 'required',
                "code" => 'required',
            ],

            "verify-sms-otp" => [
                "pin_id" => "required",
                "pin"=> "required",
            ],

            "create_role" => [
                "name" => "required"
            ],

            "create_permission" => [
                "name" => "required"
            ],

            "edit_role" =>[
                "role_id" => "required",
                "name" => "required"
            ],
            "manageRole" => [
                "user_id" => "required",
                "role_id" => "required",
            ],
            "role" => [
                "role_id" => "required",
                "permission" => "required"
            ],

            "getRolePermissions"=>[
                "role_id" => "required"
            ],

            "getManager"=>[
                "manager_id" => "required"
            ],

            "updateManager"=>[
                "manager_id"=>'required',
                'name' => 'required',
                "phone" => "required",
                'email' => 'required',
                'address' => 'required',
                'dob' => 'required',
                'image' => 'required',
                'gender' => 'required',
            ]

        ];

        return Validator::make($request->all(), self::$validation_rules[$arg]);

        
    }
 }