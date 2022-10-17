<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Validations\GlobalValidator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;



class RolesController extends Controller
{
    public function createRole(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "create_role");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            Role::create(['name' => $request->name]);
            return Functions::sendResponse([], "Role created successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function getRoles(){
        return Functions::sendResponse(Role::all(), "Role fetched successfully");
    }

    public function getRolePermissions(Request $request){

        try {
            $validator = GlobalValidator::validation_rules($request, "getRolePermissions");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            $role = Role::find($request->role_id);
            return Functions::sendResponse($role->permissions, "Role permissions generated successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
      
    }

    public function editRole(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "edit_role");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            Role::where("id", $request->role_id)->update(['name' => $request->name]);
            return Functions::sendResponse([], "Role updated successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function removeRole(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "manageRole");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            $role = Role::find($request->role_id);
            $user = User::find($request->user_id);
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            $user->removeRole($role->name);
           
            return Functions::sendResponse([], "Role removed successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function assignRole(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "manageRole");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            $role = Role::find($request->role_id);
            $user = User::find($request->user_id);

            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

            $user->assignRole($role->name);

            return Functions::sendResponse([], "Role assigned successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function addSinglePermissiontoRole(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "role");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            $role = Role::find($request->role_id);
            $role->givePermissionTo($request->permission);
            return Functions::sendResponse([], "Permission assigned to role successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function addMultiplePermissiontoRole(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "role");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            $role = Role::find($request->role_id);
            $role->syncPermissions($request->permission);
            return Functions::sendResponse([], "Permission assigned to role successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function revokeRolePermission(Request $request){

        try {
            $validator = GlobalValidator::validation_rules($request, "role");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            $role = Role::find($request->role_id);
            $role->revokePermissionTo($request->permission);
            return Functions::sendResponse([], "Role permission rovoked successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }
}
