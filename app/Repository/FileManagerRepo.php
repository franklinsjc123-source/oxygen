<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\FileManager;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\ViewModels\UserVM;

class FileManagerRepo
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

    public function saveFile($viewModel)
    {
        $sql =  $this->dataQuery->composeSP("FilesSave", $viewModel);
        $result =  DB::select($sql->sp, $sql->param); 
        return  $result[0]->FileId;
    }
    
    public function deleteFile($fileID, $loginUserId)
    {
        $sql =  $this->dataQuery->composeSP("FilesDelete", ['FileId'=>$fileID, 'LoginUserId'=>$loginUserId]);
        return DB::select($sql->sp, $sql->param);
    }

    public function getFileData($fileID)
    {
        $obj = FileManager::find($fileID);
        return $obj;
    }

    public function getFileDataByPK($PKId, $TableName)
    {
        $obj = FileManager::where('PK',$PKId)->where('TableName',$TableName)->get();
        return $obj;
    }
}
