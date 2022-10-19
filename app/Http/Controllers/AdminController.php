<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use App\Interface\AdminInterface;
use App\Interface\ManagerInterface;
use App\Models\User;
use App\Validations\GlobalValidator;
use  PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    
    protected $admin;

    public function __construct(AdminInterface $admin)
    {
        $this->middleware(['role:super-admin']);
        $this->admin = $admin;
        $this->uid = JwtAuth::parseToken()->authenticate()->id;
    }

    public function create(ManagerRequest $request)
    {
        $data = $this->admin->createDatas($request);
        return $data;
    }


    public function getAllAdmins()
    {
        $data = $this->admin->getAllDatas();
        return $data;
    }

    public function getAdmin(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "getAdmin");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }
        $data = $this->admin->getData($request->admin_id);
        return $data;
    }

    public function update(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "updateAdmin");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }
        $data = $this->admin->updateData($request, $request->admin_id);
        return $data;
    }

    public function changeStatus(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "getAdmin");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }
        $data = $this->admin->changeStatus($request->admin_id);
        return $data;
    }



    
}
