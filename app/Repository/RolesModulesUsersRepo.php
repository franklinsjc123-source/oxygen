<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\RolesModulesUsers;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM; 

class RolesModulesUsersRepo
{
    protected DataQueryHelper $dataQuery;
    protected ObjectHelper $objectHelper;
    protected CommonHelper $commonHelper;
    protected Container $container;
    protected UserVM $userVM;

    function __construct(
        DataQueryHelper $dataQuery, 
        ObjectHelper $objectHelper,
        CommonHelper $commonHelper,
        UserVM $userVM
    )
    {
        $this->container = Container::getInstance();
        $this->dataQuery = $dataQuery;
        $this->objectHelper = $objectHelper;
        $this->commonHelper = $commonHelper;
        $this->userVM = $userVM;
    }

    public function getRolesModulesUsers($RoleModuleUserId, $UserId)
    {
        $sql =  $this->dataQuery->composeSP("RolesModulesUsersGet", ['RoleModuleUserId' => $RoleModuleUserId, 'UserId' => $UserId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function saveRolesModulesUsers($viewModel){
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("RolesModulesUsersSave", $viewModel);

        $result =  DB::select($sql->sp, $sql->param);

        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->RoleModuleUserId =  $result[0]->RoleModuleUserId;

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }
    public function deleteRolesModulesUsers($RoleModuleUserId)
    {
        $result = RolesModulesUsers::destroy($RoleModuleUserId);
        $commonReturn = new CommonReturnVM();
        $commonReturn->statusCode =  1;
        $commonReturn->statusMsg = "Successfully Removed the record...";
        $commonReturn->data = $result;
        return $commonReturn;
    }


}