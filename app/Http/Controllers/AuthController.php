<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Validations\GlobalValidator;
use App\Helpers\Functions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "register");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first());
        }

        if(DB::table('users')->where('phone', $request->phone)->exists()){
            return Functions::sendError('Phone number already in use by another customer.', 400);
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password, ['memory' => 1024,'time' => 2,'threads' => 2,]);
        $input['role_id'] = 2;
        $input['status'] = "Active";
        $user = User::create($input);
        $success['token'] = Auth::attempt(["email"=>$request->email, "password"=>$request->password]);
        $success['data'] =  $user;

        return Functions::sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request){

        $validator = GlobalValidator::validation_rules($request, "login");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }


        $loginField = request()->input('user');
        $credentials = null;

        if ($loginField !== null) {
            $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            request()->merge([ $loginType => $loginField ]);
            $credentials = request([ $loginType, 'password' ]);
        } else {
            return Functions::sendError('Invalid username or password.', ['error'=>'Invalid username or password'], 400);
        }
    
        if (! $token = auth()->attempt($credentials)) {
            return Functions::sendError('Invalid username or password.', ['error'=>'Invalid username or password'], 400);
        }
        
        $user = User::with('roles.permissions')->where('phone', $request->user)->orWhere('email', $request->user)->first();

        $success['token'] = $token; 
        $success['roles'] = $user->roles;
        $success['name'] =  $user->name;
        $success['phone'] = $user->phone;
        $success['address'] = $user->address;
        $success['email'] = $user->email;
        $success['image'] = $user->image;

        return Functions::sendResponse($success, 'User login successfully.');
 
    }
    
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
