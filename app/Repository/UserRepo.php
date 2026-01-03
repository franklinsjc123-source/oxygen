<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\User;
use App\Models\Departments;
use App\Helper\DataQueryHelper;
use App\Helper\SystemCryptoHelper;
use App\Helper\ObjectHelper;
use App\Models\ViewModels\CommonReturnVM;

class UserRepo
{
      private $key = "fmtjRKqbCm0=";
      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected SystemCryptoHelper $systemCryptoHelper;
      protected Container $container;

      function __construct(DataQueryHelper $dataQuery, ObjectHelper $objectHelper, SystemCryptoHelper $systemCryptoHelper)
      {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
            $this->systemCryptoHelper = $systemCryptoHelper;
      }

      public function getUser($UserId)
      {
            //don't use first or Create (that will create new record identity will increase)
            $obj = User::select( 
                  'User.UserId',
                  'User.UserName',
                  'User.Password',
                  'User.PersonName',
                  'User.FullName',
                  'User.PhoneNo',
                  'User.Email',
                  'User.DepartmentId',
                  
                  'User.UserStatusId',
                  'CUser.CreatedBy',
                  'CUser.PersonName as CreatedByName',
                  User::raw('CONVERT(varchar, [User].CreatedDate, 103) as CreatedDate'),
                  'MUser.ModifiedBy',
                  'MUser.PersonName as ModifiedByName',
                  User::raw('CONVERT(varchar, [User].ModifiedDate, 103) as ModifiedDate'),
                  'SystemConfigs.Description as UserStatusDesc',
            )
            ->leftJoin("User as CUser", "CUser.UserId", "=", "User.CreatedBy")
            ->leftJoin("User as MUser", "MUser.UserId", "=", "User.ModifiedBy")
            ->leftJoin("SystemConfigs",function($join){
                  $join->on("SystemConfigs.TypeId", "=", "User.UserStatusId");
                  $join->where("SystemConfigs.Category", "=", "User");
            })
            ->where("User.UserId", "=", "$UserId")
            ->first();            
            if ($obj != null) {  
                  if($obj->Password != ""){
                        $obj->Password = $this->systemCryptoHelper->decrpty($obj->Password, $this->key); 
                  }
                  return $obj;                 
            } else {
                  return $this->container->make(User::class); //* Create new Object */
            } 
      }

      public function getAllUser()
      {
            $sql =  $this->dataQuery->composeSP("UserGet");
            return DB::select($sql->sp);
      } 

      public function saveUser($viewModel): CommonReturnVM
      {
            
            $viewModel->Password = $this->systemCryptoHelper->encrypt($viewModel->Password, $this->key);
           
            $this->objectHelper->removeProperties($viewModel, ['CreatedDate','CreatedByName','ModifiedDate','ModifiedByName']); 
            $commonReturn = new CommonReturnVM();                  
            $sql =  $this->dataQuery->composeSP("UserSave", $viewModel);
            $result =  DB::select($sql->sp, $sql->param);                
            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            $viewModel->UserId =  $result[0]->UserId;
            
            $viewModel->Password = $this->systemCryptoHelper->decrpty($viewModel->Password, $this->key);
            
            $commonReturn->data = $viewModel;            
            return $commonReturn;
      }

      public function checkUserEmail($UserId, $Email)
      {
            $existingData = User::where('UserId', '<>', $UserId)->where('Email', '=', $Email)->get()->first();
            if ($existingData != null) {
                  return true;
            }
            return false;
      }

      public function checkUserName($UserId, $UserName)
      {
            $existingData = User::where('UserId', '<>', $UserId)->where('UserName', '=', $UserName)->get()->first();
            if ($existingData != null) {
                  return true;
            }
            return false;
      }

}