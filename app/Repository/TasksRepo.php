<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\SprintBacklogs;
use App\Models\Tasks;
use App\Models\SystemConfigs;
use App\Models\ViewModels\CommonReturnVM;

class TasksRepo
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

    public function getAllTasks($loginUserId, $planStatus, $SysProjecId, $PBLId, $SprintId)
    {
        $sql =  $this->dataQuery->composeSP("TasksGetAll", ['LoginUserId' => $loginUserId, 'PlanStatus' => $planStatus, 'SysProjectId' => $SysProjecId, 'PBLId' => $PBLId, 'SprintId' => $SprintId]);
        
        return DB::select($sql->sp, $sql->param);
    }

    public function getTasks($SprintId, $TasksId)
    {
        $sql =  $this->dataQuery->composeSP("TasksGet", ['SprintId' => $SprintId, 'TaskId' => $TasksId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function getDevelopersByTasks($loginUserId, $SprintId)
    {
        $sql =  $this->dataQuery->composeSP("DevelopersByTasksGet", ['LoginUserId' => $loginUserId, 'SprintId' => $SprintId]);
        
        return DB::select($sql->sp, $sql->param);
    }

    public function saveTasks($viewModel): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("TasksSave", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);

        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->TaskId =  $result[0]->TaskId;

        $viewModel->ActualEndDate = $this->commonHelper->getBladeDateTimeFormat($viewModel->ActualEndDate);
        $viewModel->ActualStartDate = $this->commonHelper->getBladeDateTimeFormat($viewModel->ActualStartDate);
        $viewModel->PlannedEndDate = $this->commonHelper->getBladeDateTimeFormat($viewModel->PlannedEndDate);
        $viewModel->PlannedStartDate = $this->commonHelper->getBladeDateTimeFormat($viewModel->PlannedStartDate);

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }

    public function searchTasks($viewModel)
    {
        $sql =  $this->dataQuery->composeSP("TasksGetAll", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);
        return $result;
    }

    // Manual Upload Begins
    
    //Excel Data server Side Validation
    function tasksValidation($tasksJsonData)
    {
        $sql =  $this->dataQuery->composeSP("TasksValidation", ['TasksData' => $tasksJsonData]);
        return DB::select($sql->sp, $sql->param);
    }

    //Excel Data Insertion
    function tasksManualInsert($tasksJsonData, $loginUserId)
    {
        $commonReturn = new CommonReturnVM();
        $sql = $this->dataQuery->composeSP("TasksManualInsert", ["TasksData" => $tasksJsonData, "LoginUserId" => $loginUserId]);
        $result = DB::select($sql->sp, $sql->param);

        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        return $commonReturn;
    }
    //Manual Uploader Ends

    public function getAssignToList($loginUserId)
    {
        $sql = $this->dataQuery->composeSP("TasksAssignToDropDown", ["UserId" => $loginUserId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function getSprintBackLogListDropDown($loginUserId, $PBLId)
    {
        $sql = $this->dataQuery->composeSP("SprintBacklogDropDown", ["UserId" => $loginUserId, "PBLId" => $PBLId]);
        return DB::select($sql->sp, $sql->param);
    }
    
    public function getProjectAndPBLbySprintGet($loginUserId, $SprintId)
    {
        $sql = $this->dataQuery->composeSP("ProjectAndPBLbySprintGet", ["LoginUserId" => $loginUserId, "SprintId" => $SprintId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function getCategoryList()
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "TasksCategory")
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }
    
    public function getTypeListDropDown($systemConfigId)
    {
        $sql = $this->dataQuery->composeSP("TypeDropDown", ["SystemConfigId" => $systemConfigId]);
        return DB::select($sql->sp, $sql->param);
    }


    public function getPlanStatusList()
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "PlanStatus")
            ->where("SystemConfigs.Category", "=", "Tasks")
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }
    public function getReasonForPostponeList()
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "PostponeReason")
            ->where("SystemConfigs.Category", "=", "TaskTracking")
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }
    public function getReasonForDelayList()
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "DelayReason")
            ->where("SystemConfigs.Category", "=", "TaskTracking")
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }
    public function checkTaskNameCheck($data)
    {
        $sql =  $this->dataQuery->composeSP("TasksNameCheck", $data);
        return DB::select($sql->sp, $sql->param);
    }

    public function getSprintName($SprintId)
    {
        $objList = SprintBacklogs::select('SprintName')
        ->where('SprintId','=',$SprintId)
        ->first();
        return $objList->Scope;
    }

    public function getPBLScope($SprintId)
    {
        $objList = SprintBacklogs::join('ProductBacklogs', 'ProductBacklogs.PBLId','=','SprintBacklogs.PBLId')
        ->select('ProductBacklogs.Scope')
        ->where('SprintBacklogs.SprintId','=',$SprintId)
        ->first();
        return $objList->ProjectName;
    }

    public function assignSprint($viewModel): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("AssignSprintToUnplannedTasks", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);

        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->TaskId =  $result[0]->TaskId;

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }

    // Daily Task List - Nirali - 24-May-22
    public function getDailyTaskList($loginUserId, $TaskId){
        $sql = $this->dataQuery->composeSP("TasksDailyList", ["LoginUserId" => $loginUserId, "TaskId" => $TaskId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function TaskTrackingSave($viewModel): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("TaskTrackingSave", $viewModel);

        $result =  DB::select($sql->sp, $sql->param);        
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->TaskTrackingId =  $result[0]->TaskTrackingId;        

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }

    public function TaskDeveloperStatusUpdate($viewModel): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("TasksDeveloperStatusUpdate", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);        
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->TaskId =  $result[0]->TaskId;        

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }



    public function GetTaskHistoryLogs($viewModel)
    {
        $sql =  $this->dataQuery->composeSP("TasksGetHistoryLogs", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);        
        return $result;
    }







    /* Not using right now  --- Nirali -----
    public function GanttChartDetailUpdate($viewModel): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("GanttChartDetailUpdate", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);        
        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->Id =  $result[0]->Id;        

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }
    */
    // for different component on dashboard -- Nirali -- 7-Jun-22 
    public function getOverDueTasks($loginUserId, $SysProjectId = -1){
        $sql =  $this->dataQuery->composeSP("TasksOverDueGet", ['LoginUserId' => $loginUserId, 'SysProjectId' => $SysProjectId]);
        
        return DB::select($sql->sp, $sql->param);
    }   
    public function getTaskSummaryByDeveloper($loginUserId, $SysProjectId = -1){
        $sql =  $this->dataQuery->composeSP("TasksSummaryByDeveloperGet", ['LoginUserId' => $loginUserId, 'SysProjectId' => $SysProjectId]);
        
        return DB::select($sql->sp, $sql->param);
    }
    public  function getActiveTaskCategory($loginUserId, $SysProjectId = -1){
        $sql =  $this->dataQuery->composeSP("TasksCountByCategory", ['LoginUserId' => $loginUserId, 'SysProjectId' => $SysProjectId]);
        
        return DB::select($sql->sp, $sql->param);
    }
    public function getTaskByDeveloper($loginUserId, $SysProjectId = -1){
        $sql =  $this->dataQuery->composeSP("TasksByDeveloper", ['LoginUserId' => $loginUserId, 'SysProjectId' => $SysProjectId]);
        
        return DB::select($sql->sp, $sql->param);
    }
    public function getDashboardSummary($loginUserId)
    {        
        $sql =  $this->dataQuery->composeSP("DashboardSummaryGet", ['LoginUserId' => $loginUserId]);
        
        return DB::select($sql->sp, $sql->param);
    }
    public function getTaskTracking($SysProjectId){
        $sql =  $this->dataQuery->composeSP("TaskTrackingGet", ['SysProjectId' => $SysProjectId]);
        
        return DB::select($sql->sp, $sql->param);
    }
}
