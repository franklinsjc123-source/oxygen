<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\User;
use App\Models\UserDetails;
use App\Helper\DataQueryHelper;
use App\Helper\SystemCryptoHelper;
use App\Helper\ObjectHelper;
use App\Models\ViewModels\CommonReturnVM;

class ProfileRepo
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

    public function getRecords($userModel) {
        $userDetails = [];
        $userDetails['user'] = User::where('id',$userModel)->first();
        $userDetails['details'] = UserDetails::where('user_id',$userModel)->first();          
        return $userDetails;
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

}