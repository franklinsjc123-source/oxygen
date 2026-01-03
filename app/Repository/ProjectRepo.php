<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM;

class ProjectRepo
{
      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected CommonHelper $commonHelper;
      protected Container $container;
      protected UserVM $userVM;

      function __construct(DataQueryHelper $dataQuery, ObjectHelper $objectHelper, UserVM $userVM, CommonHelper $commonHelper)
      {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
            $this->commonHelper = $commonHelper;
            $this->userVM = $userVM;
      }

      public function getProject($loginUserId, $SysProjectId, $StatusId)
      {            
            $sql =  $this->dataQuery->composeSP("ProjectsGet",["LoginUserId" => $loginUserId, "SysProjectId" => $SysProjectId, 'StatusId' => $StatusId]); 
            return DB::select($sql->sp, $sql->param); 
      }

      public function saveProjects($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();
            $sql =  $this->dataQuery->composeSP("ProjectsSave", $viewModel);
            $result =  DB::select($sql->sp, $sql->param);

            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            $viewModel->SysProjectId =  $result[0]->SysProjectId;

            $viewModel->DateStarted = $this->commonHelper->getBladeDateFormat($viewModel->DateStarted);
            $viewModel->DateClosed = $this->commonHelper->getBladeDateFormat($viewModel->DateClosed);
            $viewModel->DateApproved = $this->commonHelper->getBladeDateFormat($viewModel->DateApproved);
            $viewModel->ExpectedEndDate = $this->commonHelper->getBladeDateFormat($viewModel->ExpectedEndDate);

            $commonReturn->data = $viewModel;
            return $commonReturn;
      }

      public function checkProject($SysProjectId, $ProjectName)
      {
            $sql = $this->dataQuery->composeSP("ProjectsNameCheck", ['ProjectId' => $SysProjectId, 'ProjectName' => $ProjectName]);
            return DB::select($sql->sp, $sql->param);
      }

      public function GetProjectsConsumedHrsByDeveloper($loginUserId)
      {
            $sql = $this->dataQuery->composeSP("ProjectsConsumedHrsByDeveloperGet", ['LoginUserId' => $loginUserId]);
            return DB::select($sql->sp, $sql->param);
      }
}
