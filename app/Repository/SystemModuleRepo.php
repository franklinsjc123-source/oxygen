<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\SystemModule;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;

class SystemModuleRepo
{

      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected CommonHelper $commonHelper;
      protected Container $container;

      function __construct(
            DataQueryHelper $dataQuery, 
            ObjectHelper $objectHelper,
            CommonHelper $commonHelper
      )
      {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
            $this->commonHelper = $commonHelper;
      }

     

      public function getAllSystemModule($SystemModuleId)
      {
            $sql =  $this->dataQuery->composeSP("SystemModuleGet", ['SystemModuleId' => $SystemModuleId]);
            return DB::select($sql->sp, $sql->param);
      } 

      public function saveSystemModule($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();
            $sql =  $this->dataQuery->composeSP("SystemModuleSave", $viewModel);
            $result =  DB::select($sql->sp, $sql->param);

            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            $viewModel->SystemModuleId =  $result[0]->SystemModuleId;

            $commonReturn->data = $viewModel;
            return $commonReturn;
      }

      public function checkSystemModule($SystemModuleId, $ModuleName)
      {
            $existingData = SystemModule::where('SystemModuleId', '<>', $SystemModuleId)->where('ModuleName', '=', $ModuleName)->get()->first();
            if ($existingData != null) {
                  return true;
            }
            return false;
      }

}