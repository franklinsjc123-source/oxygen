<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\CustomerInfo;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;

class UserAccessRightRepo
{

      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $object;

      function __construct(DataQueryHelper $dataQuery, ObjectHelper $object)
      {
            $this->dataQuery = $dataQuery;
            $this->object = $object;
      }

      public function getUserDetails($UserId)
      {
            $sql =  $this->dataQuery->composeSP("UserGet", array('UserId'=>$UserId));
            return DB::select($sql->sp, $sql->param);
      } 

      public function getUserAccessDetails($UserId)
      {
            $sql =  $this->dataQuery->composeSP("UserAccessRightGet", array('UserId'=>$UserId));
            return DB::select($sql->sp, $sql->param);
      }

      public function checkUserAccessRight($criteria)
      {
            $criteria = $this->object->keepProperties($criteria, array("LoginUserId", "ModuleId"));
            $sql = $this->dataQuery->composeSP("UserAccessLevelByModuleGet",  $criteria);
            $checkAccessObj = DB::select($sql->sp, $sql->param);

            //dd($checkAccessObj);

            if (empty($checkAccessObj)) {
                  return false;
            } elseif ($checkAccessObj[0]->isAccessible == 'Yes') {
                  return true;
            }
      }

      public function updateMenuAccessRight($criteria)
      {
            $criteria = $this->object->keepProperties($criteria, array("AccessModuleId", "AccessMenuId", "UserId", "AccessStatus", "LoginUserId"));
            $sql = $this->dataQuery->composeSP("UserMenuAccessRightSave",  $criteria);
            return DB::select($sql->sp, $sql->param)[0];
      }

      public function updateMenuRecordAccessRight($criteria)
      {
            $criteria = $this->object->keepProperties($criteria, array("AccessMenuRecordId", "UserId", "AccessStatus", "LoginUserId"));
            $sql = $this->dataQuery->composeSP("UserMenuRecordAccessRightSave",  $criteria);
            return DB::select($sql->sp, $sql->param)[0];
      }
}
