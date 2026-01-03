<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\ProjectRole;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM; 

class ProjectRoleRepo
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


      public function getAllProjectRole($ProjectRoleId)
      {
            $sql =  $this->dataQuery->composeSP("ProjectRoleGet", ['ProjectRoleId' => $ProjectRoleId]);
            return DB::select($sql->sp, $sql->param);      
      } 

      
      public function saveProjectRole($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();
            $sql =  $this->dataQuery->composeSP("ProjectRoleSave", $viewModel);
            $result =  DB::select($sql->sp, $sql->param);

            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            $viewModel->ProjectRoleId =  $result[0]->ProjectRoleId;

            $commonReturn->data = $viewModel;
            return $commonReturn;
      }

      public function checkProjectRole($ProjectRoleId, $RoleName)
      {
            $existingData = ProjectRole::where('ProjectRoleId', '<>', $ProjectRoleId)->where('RoleName', '=', $RoleName)->get()->first();            
            if ($existingData != null) {
                  return true;
            }
            return false;
      }

}