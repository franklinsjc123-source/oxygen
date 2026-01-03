<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM;

class ProjectMembersRepo
{
      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
	protected CommonHelper $commonHelper;
      protected Container $container;
	protected UserVM $userVM;

      function __construct(DataQueryHelper $dataQuery, ObjectHelper $objectHelper,UserVM $userVM, CommonHelper $commonHelper)
      {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
		$this->commonHelper = $commonHelper;
            $this->objectHelper = $objectHelper;
		$this->userVM = $userVM;
      }

      public function getProjectMembers($ProjectMemberId, $loginUserId)
      { 
            $sql =  $this->dataQuery->composeSP("ProjectMembersGet",["ProjectMemberId" => $ProjectMemberId, "SysProjectId" => '', 'LoginUserId' => $loginUserId]);       
            return DB::select($sql->sp, $sql->param);
      }

      public function saveProjectMembers($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();
            $sql =  $this->dataQuery->composeSP("ProjectMembersSave", $viewModel);
            $result =  DB::select($sql->sp, $sql->param);             
            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            if(isset($result[0]->ProjectMemberId)){
                  $viewModel->ProjectMemberId =  $result[0]->ProjectMemberId;
            }

		$viewModel->DateJoin = $this->commonHelper->getBladeDateFormat($viewModel->DateJoin);

            $commonReturn->data = $viewModel;
            return $commonReturn;
      }
}
