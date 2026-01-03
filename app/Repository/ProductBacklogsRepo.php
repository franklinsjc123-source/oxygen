<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\User;
use App\Models\ProductBacklogs;
use App\Models\SystemConfigs;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;

class ProductBacklogsRepo
{
    protected DataQueryHelper $dataQuery;
    protected ObjectHelper $objectHelper;
    protected CommonHelper $commonHelper;
    protected Container $container;

    function __construct(DataQueryHelper $dataQuery, ObjectHelper $objectHelper, CommonHelper $commonHelper)
    {
        $this->container = Container::getInstance();
        $this->dataQuery = $dataQuery;
        $this->objectHelper = $objectHelper;
        $this->commonHelper = $commonHelper;
    }

    public function getProductBacklogs($projectId, $PBLId, $LoginUserId)
    {
        $sql =  $this->dataQuery->composeSP("ProductBacklogsGet", array('ProjectId' => $projectId, 'PBLId'=>$PBLId, 'LoginUserId'=>$LoginUserId) );
        return DB::select($sql->sp, $sql->param);
    }

    public function productBacklogsPhaseUpdate($PBLId, $PhaseId, $loginUserId)
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("ProductBacklogsPhaseUpdate", ["PBLId" => $PBLId, 'PhaseId' => $PhaseId, 'LoginUserId' => $loginUserId]);
        $result =  DB::select($sql->sp, $sql->param);
        
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        return $commonReturn;
    }

    public function productBacklogsSave($data): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("ProductBacklogsSave", $data);
        $result =  DB::select($sql->sp, $sql->param);
        $data->PBLId = $result[0]->PBLId;
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        
        $data->ActualStartDate = $this->commonHelper->getBladeDateFormat($data->ActualStartDate);
        $data->ActualFinishDate = $this->commonHelper->getBladeDateFormat($data->ActualFinishDate);
        $data->PlanedStartDate = $this->commonHelper->getBladeDateFormat($data->PlanedStartDate);
        $data->PlanedEndDate = $this->commonHelper->getBladeDateFormat($data->PlanedEndDate);
        
        $commonReturn->data = $data;
        return $commonReturn;
    }

    public function getAllProductBacklog($loginUserId)
    {
        $sql =  $this->dataQuery->composeSP("ProductBacklogsGetAll", array('LoginUserId' => $loginUserId) ); 
        return DB::select($sql->sp, $sql->param);
    }

    public function productBacklogsScopeCheck($projectId, $scope)
    {
        $sql =  $this->dataQuery->composeSP("ProductBacklogsScopeCheck", array('ProjectId' => $projectId, 'Scope' => $scope) ); 
        return DB::select($sql->sp, $sql->param);
    }

}