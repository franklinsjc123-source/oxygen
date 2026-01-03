<?php

namespace App\Repository;

use Illuminate\Container\Container;
use App\Models\User;
use App\Models\ViewModels\CommonReturnVM;
use App\Helper\DataQueryHelper;
use App\Helper\SystemCryptoHelper;
use App\Helper\ObjectHelper;
use Illuminate\Support\Facades\DB;
class AuthRepo
{
      private $key = "fmtjRKqbCm0=";
      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected SystemCryptoHelper $systemCryptoHelper;
      protected Container $container;

      function __construct(
            DataQueryHelper $dataQuery, 
            ObjectHelper $objectHelper,
            SystemCryptoHelper $systemCryptoHelper,
      )
      {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
            $this->systemCryptoHelper = $systemCryptoHelper;
      }

      public function getUserDetails($UserName, $Password)
      {
            $userDataObj = User::where('UserName',$UserName)->first();

            if ($userDataObj != null) {
                  $userDataObj->Password = $this->systemCryptoHelper->decrpty($userDataObj->Password, $this->key); 
                  if ($userDataObj->Password == $Password) {
                        return $userDataObj;
                  } else {
                        return null;
                  }
            } else {
                  return null;
            }
      }

      public function getUser($UserId)
      {
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

      public function checkUserName($UserName)
      {
            $existing_record = User::where('UserName', '=', $UserName)->get()->first();
            if ($existing_record != null) {
                  return true;
            }
            return false;
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


      public function updatePassword($viewModel): CommonReturnVM
      {
            
            $viewModel->Password = $this->systemCryptoHelper->encrypt($viewModel->Password, $this->key);
            
            $commonReturn = new CommonReturnVM();                  
            $sql =  $this->dataQuery->composeSP("UpdateUserPassword", $viewModel);
            $result =  DB::select($sql->sp, $sql->param);                
            
            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            $viewModel->UserId =  $result[0]->UserId;
            
            $viewModel->Password = $this->systemCryptoHelper->decrpty($viewModel->Password, $this->key);
            
            $commonReturn->data = $viewModel;            
            return $commonReturn;
      }


      public function checkId($key)
      {
            if(config('app.secret_key') == $key){
                  return true;
            }else{
                  return false;
            }
      }

      public function checkUser()
      {
            $users= User::select('*')->get();
            if($users->isEmpty()){
                  return true;
            }else{
                  return false;
            }
      }

      public function checkUserByMail($email)
      {
            return User::select('*')->where('Email',$email)->first();
      }

      public function getEncrptKey($email,$userId)
      {
            $inputKey = $email.'_'.$userId;
            $encrptKey = $this->systemCryptoHelper->encrypt($inputKey, $this->key);
            return $this->systemCryptoHelper->composeURLFriendly($encrptKey);
      }

      public function getDecrptyKey($encrptKey)
      {
            $encrptKey = $this->systemCryptoHelper->deComposeURLFriendly($encrptKey);
            return $this->systemCryptoHelper->decrpty($encrptKey, $this->key);
      }
}
