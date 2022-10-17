<?php

namespace App\Repositories;

// use App\Services\;

use App\Helpers\Functions;
use App\Http\Resources\ManagerResource;
use App\Interface\ManagerInterface;
use App\Mail\SESAMAIL;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManagerRepo implements ManagerInterface
{
    public function getAllDatas()
    {
        $data = Manager::with('user')->get();
        if ($data->isEmpty()) {
           return Functions::sendResponse([], "No data found");
        }
        return Functions::sendResponse($data, "successful");
    }
    
    public function getData($Id)
    {
        $data = Manager::with('user')->where('id', $Id)->first();
        if (!$data) {
            return Functions::sendResponse([], "No data found");
        }
        return Functions::sendResponse($data, "successful");
    }

    public function createDatas($request)
    {  
          
        try {
            //create user/login credentials
            $user = User::createUser($request);
            if(!$user){
                return Functions::sendError("Error occured while trying to create manager", [], 400);
            }
            //other user credentials
            $manager = new Manager();
            $manager->user_id = $user->id;
            $manager->dob = $request->dob;
            $manager->address = $request->address;
            $manager->save();

            if(!$manager){
                return Functions::sendError("Error occured while trying to create manager", [], 400);
            }

            //Add ZOHO MAIL API Job Here...

            return Functions::sendResponse([], "Manager created successfully");
        
        } catch (\Throwable $th) {
            return Functions::sendError($th->getMessage(), [], 400);
        }
        
    }

    public function updateData($request, $Id)
    {
        try {
            $data = Manager::find($Id);
            if (!$data) {
                return Functions::sendResponse([], "No data found");
            }
            $user = User::existingEmailPhone($request, $data->user_id);
            if($user->status){
                return Functions::sendError($user->response, [], 400);
            }
            $data->address = $request->address;
            $data->dob = $request->dob;
            $data->save();
            if($data){
                $user = User::updateUser($request, $data->user_id);
                if($user){
                    return Functions::sendResponse([], "Manager updated successfully");
                }
                else{
                    return Functions::sendError("Error occured while trying to create manager", [], 400);
                }
            }
            else{
                return Functions::sendError("Error occured while trying to update manager", [], 400);
            }
           
        } catch (\Throwable $th) {
            return Functions::sendError($th->getMessage(), [], 400);
        }
        
    }
    
    public function changeStatus($id)
    {
        try {
            $manager = Manager::find($id);
            if (!$manager) {
                return Functions::sendResponse([], "No data found");
            }
            $user = User::where('id', $manager->user_id)->first();
            $user->status = !$user->status;
            $user->save();

            if($user){
                return Functions::sendResponse([], "Status updated successfully");
            }
            else{

            }
        } catch (\Throwable $th) {
            return Functions::sendError($th->getMessage(), [], 400);
        }
    }

    // public function search($request)
    // {
    //         // // this collects the input from the request

    //         // $q = $request->input('search');

    //         // // this performs the logic of query the database for the specific propertise
    //         // $property = Manager::query()->where('f_name', 'LIKE', "%{$q}")->
    //         // orWhere('l_name', 'LIKE', "%{$q}")->
    //         // orWhere('gender', 'LIKE', "%{$q}")->
    //         // orWhere('status', 'LIKE', "%{$q}")->get();
    //         // // orWhere('estate', 'LIKE', "%{$q}")->get();
    
    
    //         // if (count($property) > 0) {
    
    //         //     return ManagerResource::collection($property);
    //         // } else {
    //         //     return response()->json([
    //         //         'error' => 'No details found. Try another search'
    //         //     ]);
    //         // }
    // }
}