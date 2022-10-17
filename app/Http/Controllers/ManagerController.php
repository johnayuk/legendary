<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use App\Interface\ManagerInterface;
use App\Models\User;
use App\Validations\GlobalValidator;
use  PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ManagerController extends Controller
{
    
    protected $manager;

    public function __construct(ManagerInterface $manager)
    {
        $this->middleware(['role:admin|super-admin']);
        $this->manager = $manager;
        $this->uid = JwtAuth::parseToken()->authenticate()->id;
    }

    public function create(ManagerRequest $request)
    {
        $data = $this->manager->createDatas($request);
        return $data;
    }


    public function getAllManagers()
    {
        $data = $this->manager->getAllDatas();
        return $data;
    }

    public function getManager(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "getManager");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }
        $data = $this->manager->getData($request->manager_id);
        return $data;
    }

    public function update(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "updateManager");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }
        $data = $this->manager->updateData($request, $request->manager_id);
        return $data;
    }

    public function changeStatus(Request $request)
    {
        $validator = GlobalValidator::validation_rules($request, "getManager");
        if($validator->fails()){
            return Functions::sendError($validator->errors()->first(), [], 400);
        }
        $data = $this->manager->changeStatus($request->manager_id);
        return $data;
    }


    // public function personalManagerInfo(Request $request)
    // {
    //     $data = $this->manager->personalInfo();
    //     return $data;
    // }


    // public function search(Request $request)
    // {
    //     $data = $this->manager->search($request);
    //     return $data;
    // }
}
