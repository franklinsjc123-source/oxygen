<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\RolesModules;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM; 

class RolesModulesRepo
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


    public function getRolesModules($RolesModulesId)
    {
        $sql =  $this->dataQuery->composeSP("RolesModulesGet", ['RolesModulesId' => $RolesModulesId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function saveRolesModules($viewModel){
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("RolesModulesSave", $viewModel);

        $result =  DB::select($sql->sp, $sql->param);

        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->RolesModulesId =  $result[0]->RolesModulesId;

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }


}