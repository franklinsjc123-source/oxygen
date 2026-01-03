<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Models\ViewModels\CommonReturnVM;

class SprintBacklogsRepo
{
    protected DataQueryHelper $dataQuery;
    protected ObjectHelper $objectHelper;
    protected Container $container;

    function __construct(DataQueryHelper $dataQuery, ObjectHelper $objectHelper)
    {
        $this->container = Container::getInstance();
        $this->dataQuery = $dataQuery;
        $this->objectHelper = $objectHelper;
    }

    public function sprintBacklogsGet($loginUserId, $pblId, $sprintId)
    {
        $sql =  $this->dataQuery->composeSP("SprintBacklogsGet", ["LoginUserId" => $loginUserId, "PBLId" => $pblId, "SprintId" => $sprintId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function sprintBacklogsGetbyProjectId($loginUserId, $projectId)
    {
        $sql =  $this->dataQuery->composeSP("SprintBacklogsGetbyProjectId", ["LoginUserId" => $loginUserId, "ProjectId" => $projectId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function sprintBacklogsGetAll($loginUserId)
    {
        $sql =  $this->dataQuery->composeSP("SprintBacklogsGetAll", ["LoginUserId" => $loginUserId]);
        return DB::select($sql->sp, $sql->param);
    }


    public function sprintBacklogsTypeUpdate($sprintId, $PhaseId, $loginUserId): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("SprintBacklogsTypeUpdate", ["SprintId" => $sprintId, 'PhaseId' => $PhaseId, 'LoginUserId' => $loginUserId]);
        $result =  DB::select($sql->sp, $sql->param);
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        return $commonReturn;
    }

    public function sprintBacklogsSave($data): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("SprintBacklogsSave", $data);
        $result =  DB::select($sql->sp, $sql->param);
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $data->SprintId =  $result[0]->SprintId;
        $commonReturn->data = $data;
        return $commonReturn;
    }

    public function getProjectListDropDown($LoginUserId)
    {
        $sql =  $this->dataQuery->composeSP("ProjectsDropDownSearch", ["UserId" => $LoginUserId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function sprintBacklogsPredecessorDropDown($PBLId, $SprintId)
    {
        $sql =  $this->dataQuery->composeSP("SprintBacklogsPredecessorDropDown", ["PBLId" => $PBLId, "SprintId" => $SprintId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function checkSprintNameCheck($data)
    {
        $sql =  $this->dataQuery->composeSP("SprintBacklogsNameCheck", $data);
        return DB::select($sql->sp, $sql->param);
    }
}
