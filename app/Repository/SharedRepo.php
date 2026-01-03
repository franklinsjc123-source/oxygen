<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\User;
use App\Models\System;
use App\Models\Departments;
use App\Models\SystemModule;
use App\Models\Projects;
use App\Models\ProjectRole;
use App\Models\MeetingTypes;
use App\Models\ProjectMembers;
use App\Models\SystemConfigs;
use App\Models\ProductBacklogs;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;

class SharedRepo
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

    public function getModelStatus($catagory)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description'
        )
            ->where('Category', '=', $catagory)
            ->where('Type', '=', 'Status')
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getModelPriority($catagory)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description'
        )
            ->where('Category', '=', $catagory)
            ->where('Type', '=', 'priority')
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getModelType($catagory)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description'
        )
            ->where('Category', '=', $catagory)
            ->where('Type', '=', 'Type')
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getModelPhases($catagory)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "Phase")
            ->where('Category', '=', $catagory)
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getDepartmentList()
    {
        $objList = Departments::select(
            'Departments.DepartmentId as id',
            'Departments.Name as description',
        )
            ->where("Departments.DepartmentStatusId", "=", "1")
            ->orderBy('Departments.DepartmentId', 'ASC')->get();
        return $objList;
    }

    public function getSystemModuleList()
    {
        $objList = SystemModule::select(
            'SystemModule.SystemModuleId as id',
            'SystemModule.ModuleName as description',
        )
            ->where("SystemModule.SystemModuleStatusId", "=", "1")
            ->orderBy('SystemModule.SystemModuleId', 'ASC')->get();
        return $objList;
    }

    public function getProjectList()
    {
        $objList = Projects::select(
            'Projects.SysProjectId as id',
            'Projects.ProjectName as description',
        )
            ->where("Projects.StatusId", "=", "1")
            ->orderBy('Projects.SysProjectId', 'ASC')->get();
        return $objList;
    }

    public function getProjectListDropDown($LoginUserId)
    {
        $sql =  $this->dataQuery->composeSP("ProjectsDropDownSearch", ["UserId" => $LoginUserId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function getUsersList()
    {
        $objList = User::select(
            'User.UserId as id',
            'User.PersonName as description',
        )
            ->where("User.UserStatusId", "=", "1")
            ->orderBy('User.UserId', 'ASC')->get();
        return $objList;
    }

    public function getSystemList()
    {
        $objList = System::select(
            'Systems.SystemId as id',
            'Systems.SystemName as description',
        )
            ->where("Systems.StatusId", "=", "1")
            ->orderBy('Systems.SystemId', 'ASC')->get();
        return $objList;
    }

    public function getProjectsRoleList()
    {
        $objList = ProjectRole::select(
            'ProjectRole.ProjectRoleId as id',
            'ProjectRole.RoleName as description',
        )
            ->where("ProjectRole.ProjectRoleStatusId", "=", "1")
            ->orderBy('ProjectRole.ProjectRoleId', 'ASC')->get();
        return $objList;
    }
    
    public function getMeetingTypeList()
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "MeetingType")
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }
    
    public function getSprintTypeList()
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "SprintType")
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getBacklogsPhases($value)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as PhaseId',
            'SystemConfigs.Description as PhaseName',
        )
            ->where("SystemConfigs.Type", "=", "Phase")
            ->where('Category', '=', $value)
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getBacklogsPhasesDropDown($value)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
            ->where("SystemConfigs.Type", "=", "Phase")
            ->where('Category', '=', $value)
            ->orderBy('SystemConfigs.TypeId', 'ASC')->get();
        return $objList;
    }

    public function getInchargeList($projectId)
    {
        $objList = ProjectMembers::select(
            'ProjectMembers.UserId as id',
            'User.PersonName as description' 
        )
        ->leftjoin('User','ProjectMembers.UserId','=','User.UserId')
        ->where('ProjectMembers.SysProjectId','=',$projectId)
        ->groupBy('ProjectMembers.UserId','User.PersonName')
        ->orderBy('ProjectMembers.UserId', 'ASC')
        ->get();

        return $objList;
    }

    public function getProjectName($projectId)
    {
        $objList = Projects::select('ProjectName')
        ->where('SysProjectId','=',$projectId)
        ->first();
        return $objList->ProjectName;
    }

    public function getProjectNameByPBL($pblId)
    {
        $objList = ProductBacklogs::join('Projects', 'Projects.SysProjectId','=','ProductBacklogs.ProjectId')
        ->select('Projects.ProjectName')
        ->where('ProductBacklogs.PBLId','=',$pblId)
        ->first();
        return $objList->ProjectName;
    }

    public function getPBLName($pblId)
    {
        $objList = ProductBacklogs::select('Scope')
        ->where('PBLId','=',$pblId)
        ->first();
        return $objList->Scope;
    }
    
    public function getProductBackLogListDropDown($sysProjectId)
    {   
        $sql =  $this->dataQuery->composeSP("ProductBacklogDropDown", ["ProjectId" => $sysProjectId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function getProjectBacklogsPredecessorDropDown($ProjectId) 
    {
        $sql = $this->dataQuery->composeSP("ProductBacklogsPredecessorDropDown", array("ProjectId" => $ProjectId));
        return DB::select($sql->sp, $sql->param);
    }

    public function getEndDate($durationDays, $startDate)
    {
        $sql =  $this->dataQuery->composeSP("sysEndDateCalculator", ['Duration' => $durationDays, "StartDate" => $startDate]);
        return DB::select($sql->sp, $sql->param);
    }


    public function getRolesModulesAccessDropDown($value)
    {
        $objList = SystemConfigs::select(
            'SystemConfigs.TypeId as id',
            'SystemConfigs.Description as description',
        )
        ->where("SystemConfigs.Type", "=", "AccessLevel")
        ->where('Category', '=', $value)
        ->orderBy('SystemConfigs.TypeId', 'ASC')->get();

        return $objList;
    }

}
