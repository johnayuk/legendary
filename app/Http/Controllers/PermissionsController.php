<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Validations\GlobalValidator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function createPermission(Request $request){
        try {
            $validator = GlobalValidator::validation_rules($request, "create_permission");
            if($validator->fails()){
                return Functions::sendError($validator->errors()->first(), [], 400);
            }
            Permission::create(['name' => $request->name]);
            return Functions::sendResponse([], "Permission created successfully");

        } catch (\Exception $e) {
            return Functions::sendError($e->getMessage(), [], 400);
        }
    }

    public function getPermissions(){
        return Functions::sendResponse(Permission::all(), "Role fetched successfully");
    }
}
