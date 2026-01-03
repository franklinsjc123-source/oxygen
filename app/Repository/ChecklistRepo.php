<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM;

class ChecklistRepo
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

	public function getChecklist($data)
	{
		$sql =  $this->dataQuery->composeSP("CheckListGet",$data);
		return DB::select($sql->sp, $sql->param);
	}
    public function saveChecklist($viewModel): CommonReturnVM
	{
		$commonReturn = new CommonReturnVM();
		$sql =  $this->dataQuery->composeSP("CheckListSave", $viewModel);
		$result =  DB::select($sql->sp, $sql->param);

		$commonReturn->statusCode =  $result[0]->statusCode;
		$commonReturn->statusMsg = $result[0]->statusMsg;
		$viewModel->CheckListId =  $result[0]->CheckListId;		
		
		$commonReturn->data = $viewModel;
        return $commonReturn;
	}
}