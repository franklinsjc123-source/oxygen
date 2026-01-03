<?php

namespace App\Repository;

use Illuminate\Container\Container;
use App\Models\Departments;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;

class DepartmentsRepo
{

      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected CommonHelper $commonHelper;
      protected Container $container;

      function __construct(
            DataQueryHelper $dataQuery,
            ObjectHelper $objectHelper,
            CommonHelper $commonHelper
      ) {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
            $this->commonHelper = $commonHelper;
      }

      public function getDepartments($DepartmentId)
      {
            $obj = Departments::select(
                  'Departments.DepartmentId',
                  'Name',
                  'DepartmentStatusId',
                  'Departments.CreatedBy',
                  'User.PersonName as CreatedByName',
                  Departments::raw("Convert(varchar, Departments.CreatedDate, 103) as CreatedDate"),
                  'MUser.ModifiedBy as ModifiedByName',
                  'Departments.ModifiedBy',
                  Departments::raw("Convert(varchar, Departments.ModifiedDate, 103) as ModifiedDate"),
                  'SystemConfigs.Description as DepartmentStatusDesc',
            )
                  ->join("User", "User.UserId", "=", "Departments.CreatedBy")
                  ->leftjoin("User as MUser", "MUser.UserId", "=", "Departments.ModifiedBy")
                  ->leftJoin("SystemConfigs", function ($join) {
                        $join->on("SystemConfigs.TypeId", "=", "Departments.DepartmentStatusId");
                        $join->where("SystemConfigs.Category", "=", "Department");
                  })
                  ->orderBy('Departments.DepartmentId', 'ASC')
                  ->where("Departments.DepartmentId", "=", "$DepartmentId")
                  ->first();

            if ($obj != null) {
                  return $obj;
            } else {
                  return $this->container->make(Departments::class);
            }
      }

      public function getAllDepartments()
      {
            $objList = Departments::select(
                  Departments::raw("row_number() over (order by Departments.DepartmentId) as RowNo"),
                  'Departments.DepartmentId',
                  'Departments.Name',
                  'DepartmentStatusId',
                  'Departments.CreatedBy',
                  'User.PersonName as CreatedByName',
                  Departments::raw("Convert(varchar, Departments.CreatedDate, 103) as CreatedDate"),
                  'Departments.ModifiedBy as ModifiedByName',
                  'MUser.PersonName',
                  Departments::raw("Convert(varchar, Departments.ModifiedDate, 103) as ModifiedDate"),
                  'SystemConfigs.Description as DepartmentStatusDesc',
            )
                  ->join("User", "User.UserId", "=", "Departments.CreatedBy")
                  ->leftjoin("User as MUser", "MUser.UserId", "=", "Departments.ModifiedBy")
                  ->leftJoin("SystemConfigs", function ($join) {
                        $join->on("SystemConfigs.TypeId", "=", "Departments.DepartmentStatusId");
                        $join->where("SystemConfigs.Category", "=", "Department");
                  })
                  ->orderBy('Departments.DepartmentId', 'ASC')->get();
            return $objList;
      }

      public function saveDepartments($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();
            $now = new \DateTime('now', new \DateTimeZone('Asia/Singapore'));
            try {
                  if ($viewModel->DepartmentId == -1) {                        
                        $this->objectHelper->removeProperties($viewModel, ['DepartmentId']);
                        $viewModel->CreatedDate = $now;
                        $model = new Departments();
                        $model->fill((array)$viewModel);
                        $model->save();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Saved";
                        $model->CreatedDate = $model['CreatedDate']->format('d/m/Y');
                        $commonReturn->data = $model;
                  } else {                        
                        $existingModel = Departments::where('DepartmentId', $viewModel->DepartmentId)->first();
                        $this->objectHelper->removeProperties($viewModel, ['CreatedDate']);
                        $existingModel->fill((array)$viewModel);
                        $existingModel->ModifiedDate = $now;
                        $existingModel->update();
                        $existingModel->CreatedDate = $this->commonHelper->getBladeDateFormat($existingModel->CreatedDate);
                        $existingModel->ModifiedDate = $existingModel['ModifiedDate']->format('d/m/Y');

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Updated";
                        $commonReturn->data = $existingModel;
                  }
            } catch (\Exception $e) {

                  $commonReturn->statusCode = -1;
                  $commonReturn->statusMsg = $e->getMessage();
                  $commonReturn->data = null;
            }

            return $commonReturn;
      }

      public function checkDepartmentsname($DepartmentId, $Name)
      {
            $existingData = Departments::where('DepartmentId', '<>', $DepartmentId)->where('Name', '=', $Name)->get()->first();

            if ($existingData != null) {
                  return response()->json("Name already exists");
            }
            return response()->json("true");
      }
}
