<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

use Illuminate\Container\Container;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\User;
use App\Models\SystemConfigs;
use App\Models\Journals;
use App\Models\ViewModels\UserVM;

class JournalsRepo
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
		$this->objectHelper = $objectHelper;
		$this->commonHelper = $commonHelper;
		$this->userVM = $userVM;
	}

	function getJournals($Pk,$TableName,$JournalId=-1)
	{		
		$sql =  $this->dataQuery->composeSP("JournalsGet",["Pk"=>$Pk,"TableName"=>$TableName,"JournalId"=>$JournalId]);
		return DB::select($sql->sp, $sql->param);
	}

	public function saveJournals($viewModel): CommonReturnVM
	{
		$commonReturn = new CommonReturnVM();
		$sql =  $this->dataQuery->composeSP("JournalsSave", $viewModel);
		$result =  DB::select($sql->sp, $sql->param);

		$commonReturn->statusCode =  $result[0]->statusCode;
		$commonReturn->statusMsg = $result[0]->statusMsg;
		$viewModel->JournalId =  $result[0]->JournalId;

		$commonReturn->data = $viewModel;
		return $commonReturn;
	}


	//Add Miscelaneous Function definitions as needed...


}