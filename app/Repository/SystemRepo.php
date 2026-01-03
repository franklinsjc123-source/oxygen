<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\System;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;

class SystemRepo
{

    protected DataQueryHelper $dataQuery;
    protected ObjectHelper $objectHelper;
    protected CommonHelper $commonHelper;
    protected Container $container;

    function __construct(
        DataQueryHelper $dataQuery, 
        ObjectHelper $objectHelper,
        CommonHelper $commonHelper
    )
    {
        $this->container = Container::getInstance();
        $this->dataQuery = $dataQuery;
        $this->objectHelper = $objectHelper;
        $this->commonHelper = $commonHelper;
    }

    public function getAllSystem($SystemId)
    {
        $sql =  $this->dataQuery->composeSP("SystemGet", ['SystemId' => $SystemId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function saveSystem($viewModel): CommonReturnVM
    {
        $commonReturn = new CommonReturnVM();
        $sql =  $this->dataQuery->composeSP("SystemSave", $viewModel);
        $result =  DB::select($sql->sp, $sql->param);

        $commonReturn->statusCode =  $result[0]->statusCode;
        $commonReturn->statusMsg = $result[0]->statusMsg;
        $viewModel->SystemId =  $result[0]->SystemId;

        $commonReturn->data = $viewModel;
        return $commonReturn;
    }

    public function checkSystem($SystemId, $SystemName)
    {
        $existingData = System::where('SystemId', '<>', $SystemId)->where('SystemName', '=', $SystemName)->get()->first();
        if ($existingData != null) {
                return true;
        }
        return false;
    }

}